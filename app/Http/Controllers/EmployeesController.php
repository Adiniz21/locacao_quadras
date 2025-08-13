<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employees;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EmployeesStoreRequest;
use App\Http\Requests\EmployeesUpdateRequest;
use Carbon\Carbon;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        $query = Employees::query()->with('user');

        if ($s = trim((string) $request->get('search'))) {
            $query->where(function ($q) use ($s) {
                $q->whereHas('user', fn($uq) => $uq->where('name', 'like', "%{$s}%"))
                    ->orWhere('position', 'like', "%{$s}%");
            });
        }

        if ($p = trim((string) $request->get('position'))) {
            $query->where('position', 'like', "%{$p}%");
        }

        $from = $request->get('hired_from');
        $to = $request->get('hired_to');

        $fromYmd = $this->toYmd($from);
        $toYmd = $this->toYmd($to);

        $query->when($fromYmd, fn($q) => $q->whereDate('hired_date', '>=', $fromYmd))
            ->when($toYmd, fn($q) => $q->whereDate('hired_date', '<=', $toYmd));

        $sortable = ['user', 'position', 'salary', 'hired_date'];
        $sort = in_array($request->get('sort'), $sortable) ? $request->get('sort') : 'hired_date';
        $dir = $request->get('dir') === 'asc' ? 'asc' : 'desc';

        if ($sort === 'user') {
            $query->join('users', 'users.id', '=', 'employees.user_id')
                ->orderBy('users.name', $dir)
                ->select('employees.*');
        } else {
            $query->orderBy($sort, $dir);
        }

        $allEmployees = $query->paginate(15)->withQueryString();

        return view('app.all_employees.index', [
            'allEmployees' => $allEmployees,
            'search' => $request->get('search'),
        ]);
    }

    public function create(Request $request): View
    {
        $this->authorize('create', Employees::class);

        $users = User::whereDoesntHave('employee') // só quem não tem vínculo
            ->pluck('name', 'id');
        $positions = Employees::positions();
        return view('app.all_employees.create', compact('users', 'positions'));
    }

    public function store(EmployeesStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Employees::class);

        $validated = $request->validated();
        $validated['hired_date'] = $this->toYmd($validated['hired_date']);

        $employees = Employees::create($validated);

        return redirect()
            ->route('all-employees.edit', $employees)
            ->withSuccess(__('crud.common.created'));
    }

    public function show(Request $request, Employees $employees): View
    {
        $this->authorize('view', $employees);

        return view('app.all_employees.show', compact('employees'));
    }

    public function edit(Request $request, Employees $employees): View
    {
        $this->authorize('update', $employees);

        $users = User::whereDoesntHave('employee') // só quem não tem vínculo
        ->pluck('name', 'id');
        $positions = Employees::positions();

        return view('app.all_employees.edit', compact('employees', 'users', 'positions'));
    }

    public function update(EmployeesUpdateRequest $request, Employees $employees): RedirectResponse
    {
        $this->authorize('update', $employees);

        $validated = $request->validated();
        $validated['hired_date'] = $this->toYmd($validated['hired_date']);

        $employees->update($validated);

        return redirect()
            ->route('all-employees.edit', $employees)
            ->withSuccess(__('crud.common.saved'));
    }

    public function destroy(Request $request, Employees $employees): RedirectResponse
    {
        $this->authorize('delete', $employees);

        $employees->delete();

        return redirect()
            ->route('all-employees.index')
            ->withSuccess(__('crud.common.removed'));
    }

    private function toYmd(?string $date): ?string
    {
        if (!$date)
            return null;
        try {
            return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
