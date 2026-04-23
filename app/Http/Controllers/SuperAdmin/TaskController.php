<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $managers = DB::table('customer')->where('role', 'manager')->where('is_active', 1)->get();
        $tasks = DB::table('manager_tasks')
            ->join('customer', 'manager_tasks.manager_id', '=', 'customer.customer_id')
            ->select('manager_tasks.*', 'customer.customer_name as manager_name')
            ->orderByDesc('manager_tasks.created_at')
            ->get();
        return view('superadmin.tasks.index', compact('managers', 'tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'manager_id'  => 'required',
            'type'        => 'required|in:task,schedule,request',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'nullable|date',
            'time_start'  => 'nullable|string',
            'time_end'    => 'nullable|string',
            'priority'    => 'required|in:low,normal,high,urgent',
        ]);

        DB::table('manager_tasks')->insert([
            'manager_id'  => $request->manager_id,
            'type'        => $request->type,
            'title'       => $request->title,
            'description' => $request->description,
            'date'        => $request->date,
            'time_start'  => $request->time_start,
            'time_end'    => $request->time_end,
            'priority'    => $request->priority,
            'status'      => 'pending',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return back()->with('success', 'Task assigned successfully.');
    }

    public function destroy($id)
    {
        DB::table('manager_tasks')->where('id', $id)->delete();
        return back()->with('success', 'Task deleted.');
    }

    // Manager updates status
    public function updateStatus(Request $request, $id)
    {
        DB::table('manager_tasks')->where('id', $id)->update([
            'status'     => $request->status,
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Status updated.');
    }
}
