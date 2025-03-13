<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employees;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EmployeesStoreRequest;
use App\Http\Requests\EmployeesUpdateRequest;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Employees::class);

        $search = $request->get('search', '');

        $allEmployees = Employees::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_employees.index',
            compact('allEmployees', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Employees::class);

        $users = User::pluck('name', 'id');

        return view('app.all_employees.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeesStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Employees::class);

        $validated = $request->validated();

        $employees = Employees::create($validated);

        return redirect()
            ->route('all-employees.edit', $employees)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Employees $employees): View
    {
        $this->authorize('view', $employees);

        return view('app.all_employees.show', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Employees $employees): View
    {
        $this->authorize('update', $employees);

        $users = User::pluck('name', 'id');

        return view('app.all_employees.edit', compact('employees', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        EmployeesUpdateRequest $request,
        Employees $employees
    ): RedirectResponse {
        $this->authorize('update', $employees);

        $validated = $request->validated();

        $employees->update($validated);

        return redirect()
            ->route('all-employees.edit', $employees)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Employees $employees
    ): RedirectResponse {
        $this->authorize('delete', $employees);

        $employees->delete();

        return redirect()
            ->route('all-employees.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
