<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;

class SuperAdminController extends Controller
{
    public function showLogin()
    {
        return view('superadmin.login');
    }

    public function login(\Illuminate\Http\Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);

        if ($request->email === 'admin@gmail.com' && $request->password === '123456') {
            session(['admin_logged_in' => true, 'admin_email' => $request->email]);
            return redirect('/superadmin/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid superadmin credentials.']);
    }

    public function dashboard()
    {
        $managers = \App\Models\Customer::where('role', 'manager')->orderByDesc('created_at')->get();
        $totalManagers = $managers->count();
        $activeManagers = $managers->where('is_active', 1)->count();
        $totalMovies = Movie::count();
        $totalBookings = DB::table('bookings')->count();

        return view('superadmin.dashboard', compact('managers', 'totalManagers', 'activeManagers', 'totalMovies', 'totalBookings'));
    }

    // Manager CRUD for superadmin
    public function managerCreate()
    {
        $modules = \App\Http\Controllers\Admin\ManagerController::MODULES;
        return view('superadmin.manager-form', compact('modules'));
    }

    public function managerIndex()
    {
        $managers = \App\Models\Customer::where('role', 'manager')->orderByDesc('created_at')->get();
        $modules = \App\Http\Controllers\Admin\ManagerController::MODULES;
        return view('superadmin.managers', compact('managers', 'modules'));
    }

    public function managerStore(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:customer,customer_email',
            'password' => 'required|min:6',
            'phone'    => 'nullable|string|unique:customer,customer_phone',
        ]);

        \Log::info('Creating manager', ['permissions' => $request->permissions, 'all' => $request->all()]);

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

        return redirect('/superadmin/dashboard')->with('success', 'Manager created.');
    }

    public function managerEdit($id)
    {
        $manager = \App\Models\Customer::where('customer_id', $id)->where('role', 'manager')->firstOrFail();
        $manager->permissions = (is_string($manager->permissions) ? json_decode($manager->permissions, true) : (array)($manager->permissions ?? []));
        $modules = \App\Http\Controllers\Admin\ManagerController::MODULES;
        return view('superadmin.manager-form', compact('manager', 'modules'));
    }

    public function managerUpdate(Request $request, $id)
    {
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
        return redirect('/superadmin/dashboard')->with('success', 'Manager updated.');
    }

    public function managerDestroy($id)
    {
        $manager = \App\Models\Customer::where('customer_id', $id)->where('role', 'manager')->firstOrFail();
        $manager->delete();
        return redirect('/superadmin/dashboard')->with('success', 'Manager deleted.');
    }
}

