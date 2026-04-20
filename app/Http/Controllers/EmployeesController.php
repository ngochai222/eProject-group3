<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;

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
            'room_id' => 'nullable|exists:rooms,id',
            'password' => 'required|string|min:8'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        Employee::create($data);

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
            'room_id' => 'nullable|exists:rooms,id',
            'password' => 'nullable|string|min:8'
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $employee->update($data);

        return redirect()->route('employees.index')->with('success');
    }

    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect()->route('employees.index')->with('success');
    }
}
