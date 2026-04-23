<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    const MODULES = [
        'movies'     => 'Movie Management',
        'showtimes'  => 'Showtimes',
        'cinemas'    => 'Cinemas',
        'seats'      => 'Seats',
        'tickets'    => 'Tickets',
        'reviews'    => 'Reviews',
        'customers'  => 'Customer Accounts',
        'pricing'    => 'Pricing',
        'promotions' => 'Promotions',
    ];

    public function index()
    {
        $managers = \App\Models\Customer::where('role', 'manager')->orderByDesc('created_at')->get();
        return view('managers.managers.index', compact('managers'));
    }

    public function create()
    {
        return view('managers.managers.create', ['modules' => self::MODULES]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:customer,customer_email',
            'password'    => 'required|min:6',
            'permissions' => 'nullable|array',
        ]);

        \App\Models\Customer::create([
            'customer_name'     => $request->name,
            'customer_email'    => $request->email,
            'customer_password' => bcrypt($request->password),
            'customer_phone'    => $request->phone ?: null,
            'role'              => 'manager',
            'is_active'         => 1,
            'permissions'       => json_encode($request->permissions ?? []),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        return redirect()->route('admin.managers.index')->with('success', 'Manager created.');
    }

    public function edit($id)
    {
        $manager = \App\Models\Customer::where('customer_id', $id)->where('role', 'manager')->firstOrFail();
        $manager->permissions = (is_string($manager->permissions) ? json_decode($manager->permissions, true) : (array)($manager->permissions ?? []));
        return view('managers.managers.edit', ['manager' => $manager, 'modules' => self::MODULES]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:customer,customer_email,'.$id.',customer_id',
            'permissions' => 'nullable|array',
        ]);

        $manager = \App\Models\Customer::where('customer_id', $id)->where('role', 'manager')->firstOrFail();
        $manager->customer_name = $request->name;
        $manager->customer_email = $request->email;
        $manager->customer_phone = $request->phone;
        $manager->permissions = json_encode($request->permissions ?? []);
        $manager->is_active = $request->has('is_active') ? 1 : 0;
        if ($request->filled('password')) {
            $manager->customer_password = bcrypt($request->password);
        }
        $manager->updated_at = now();
        $manager->save();
        return redirect()->route('admin.managers.index')->with('success', 'Manager updated.');
    }

    public function destroy($id)
    {
        $manager = \App\Models\Customer::where('customer_id', $id)->where('role', 'manager')->firstOrFail();
        $manager->delete();
        return back()->with('success', 'Manager deleted.');
    }

    // Manager login
    public function showLogin()
    {
        return view('managers.manager-login');
    }

    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);

        // Superadmin check
        if ($request->email === 'admin@gmail.com' && $request->password === '123456') {
            session(['role' => 'admin', 'admin_email' => $request->email]);
            return redirect('/superadmin/dashboard');
        }

        // Manager check
        $manager = \App\Models\Customer::where('customer_email', $request->email)
            ->where('role', 'manager')
            ->where('is_active', 1)
            ->first();
        if ($manager && password_verify($request->password, $manager->customer_password)) {
            session([
                'role'                => 'manager',
                'manager_id'          => $manager->customer_id,
                'manager_name'        => $manager->customer_name,
                'manager_email'       => $manager->customer_email,
                'manager_permissions' => (is_string($manager->permissions) ? json_decode($manager->permissions, true) : (array)($manager->permissions ?? [])),
            ]);
            return redirect('/managers/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
}


