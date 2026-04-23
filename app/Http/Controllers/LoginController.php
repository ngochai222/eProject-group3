<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');
        $username = $credentials['username'];
        $password = $credentials['password'];

        // 1. Superadmin check (customer table with role=admin OR superadmins table)
        $superadmin = \DB::table('superadmins')->where('email', $username)->first();
        if ($superadmin && password_verify($password, $superadmin->password)) {
            session(['role' => 'admin', 'admin_logged_in' => true, 'admin_email' => $superadmin->email, 'admin_name' => $superadmin->name]);
            return redirect('/superadmin/dashboard');
        }

        // Also check customer table with role=admin
        $adminCustomer = \DB::table('customer')->where('customer_email', $username)->where('role', 'admin')->first();
        if ($adminCustomer && password_verify($password, $adminCustomer->customer_password)) {
            session(['role' => 'admin', 'admin_logged_in' => true, 'admin_email' => $adminCustomer->customer_email]);
            return redirect('/superadmin/dashboard');
        }

        // 2. Manager check (customer table with role=manager)
        $manager = \DB::table('customer')->where('customer_email', $username)->where('role', 'manager')->first();
        if ($manager && password_verify($password, $manager->customer_password)) {
            $perms = $manager->permissions;
            if (is_string($perms)) {
                $perms = json_decode($perms, true);
                if (is_string($perms)) $perms = json_decode($perms, true);
            }
            $permissions = (array)($perms ?? []);
            session([
                'role'                => 'manager',
                'manager_logged_in'   => true,
                'manager_id'          => $manager->customer_id,
                'manager_name'        => $manager->customer_name,
                'manager_email'       => $manager->customer_email,
                'manager_permissions' => $permissions,
            ]);
            return redirect('/managers/dashboard');
        }

        // 3. Customer check
        if (Auth::guard('customer')->attempt(['customer_email' => $username, 'password' => $password], $remember)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Welcome back!');
        }

        Log::warning('Login attempt failed:', ['email' => $username]);

        return back()->withErrors([
            'username' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
