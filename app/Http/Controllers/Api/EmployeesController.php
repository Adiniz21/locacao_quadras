<?php

namespace App\Http\Controllers\Api;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeesResource;
use App\Http\Resources\EmployeesCollection;
use App\Http\Requests\EmployeesStoreRequest;
use App\Http\Requests\EmployeesUpdateRequest;

class EmployeesController extends Controller
{
    public function index(Request $request): EmployeesCollection
    {
        $this->authorize('view-any', Employees::class);

        $search = $request->get('search', '');

        $allEmployees = Employees::search($search)
            ->latest()
            ->paginate();

        return new EmployeesCollection($allEmployees);
    }

    public function store(EmployeesStoreRequest $request): EmployeesResource
    {
        $this->authorize('create', Employees::class);

        $validated = $request->validated();

        $employees = Employees::create($validated);

        return new EmployeesResource($employees);
    }

    public function show(
        Request $request,
        Employees $employees
    ): EmployeesResource {
        $this->authorize('view', $employees);

        return new EmployeesResource($employees);
    }

    public function update(
        EmployeesUpdateRequest $request,
        Employees $employees
    ): EmployeesResource {
        $this->authorize('update', $employees);

        $validated = $request->validated();

        $employees->update($validated);

        return new EmployeesResource($employees);
    }

    public function destroy(Request $request, Employees $employees): Response
    {
        $this->authorize('delete', $employees);

        $employees->delete();

        return response()->noContent();
    }
}
