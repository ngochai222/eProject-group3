<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Models\Room;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['user', 'room'])->latest()->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $users = User::all();
        $rooms = Room::all();

        return view('employees.create', compact('users', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:20',
            'position' => 'required|in:staff,manager,admin',
            'salary' => 'nullable|numeric',
            'room_id' => 'nullable|exists:rooms,id'
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success');
    }

    public function show($id)
    {
        $employee = Employee::with(['user', 'room'])->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $users = User::all();
        $rooms = Room::all();

        return view('employees.edit', compact('employee', 'users', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'position' => 'required|in:staff,manager,admin',
            'salary' => 'nullable|numeric',
            'room_id' => 'nullable|exists:rooms,id'
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success');
    }

    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect()->route('employees.index')->with('success');
    }
}
