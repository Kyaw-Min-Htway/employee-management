<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'position' => 'required|string|max:255',
        ])

        $employee = Employee::create($validatedData);

        return response()->json($employee, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        return $employee::where('uuid', $uuid)->firstOrFail();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $employee = Employee::where('uuid', $uuid)->firstOrFail();

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:employees,email,' . $employee->id,
            'position' => 'string|max:255',
        ]);

        $employee->update($validatedData);

        return response()->json($employee, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $employee = Employee::where('uuid', $uuid)->firstOrFail();
        $employee->delete();

        return response()->json(null, 204);
    }
}
