<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return Employee::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'position' => 'required|string|max:255',
        ]);

        $employee = Employee::create($validatedData);

        return response()->json($employee, 201);
    }

    public function show($uuid)
    {
        return Employee::where('uuid', $uuid)->firstOrFail();
    }

    public function update(Request $request, $uuid)
    {
        $employee = Employee::where('uuid', $uuid)->firstOrFail();

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:employees,email,' . $employee->uuid . ',uuid',
            'position' => 'string|max:255',
        ]);

        $employee->update($validatedData);

        return response()->json($employee, 200);
    }

    public function destroy($uuid)
    {
        $employee = Employee::where('uuid', $uuid)->firstOrFail();
        $employee->delete();

        return response()->json(null, 204);
    }
}

