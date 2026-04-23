<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        $totalActive = Customer::count();
        $selected = $customers->first();
        return view('managers.customers.index', compact('customers', 'totalActive', 'selected'));
    }

    public function show($id)
    {
        $customers = Customer::latest()->paginate(10);
        $totalActive = Customer::count();
        $selected = Customer::findOrFail($id);
        return view('managers.customers.index', compact('customers', 'totalActive', 'selected'));
    }

    public function suspend($id)
    {
        // Toggle suspend - add a status field if needed
        return back()->with('success', 'Account suspended.');
    }
}


