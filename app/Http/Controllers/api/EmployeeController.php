<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = DB::table('employees')->get();
        return json_encode(['employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'position' => ['required', 'in:cajero,administrador,cocinero,mensajero'],
            'identification_number' => ['required', 'max:20'],
            'salary' => ['required', 'numeric'],
            'hire_date' => ['required', 'date'],
        ]);

        $employee = new Employee();
        $employee->user_id = $request->user_id;
        $employee->position = $request->position;
        $employee->identification_number = $request->identification_number;
        $employee->salary = $request->salary;
        $employee->hire_date = $request->hire_date;
        $employee->save();

        return json_encode(['employee' => $employee]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            return abort(404);
        }
        return json_encode(['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
