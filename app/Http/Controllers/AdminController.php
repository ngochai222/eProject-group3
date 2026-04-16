<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Hardcoded admin credentials
        if ($email === 'admin@gmail.com' && $password === '123456') {
            // Manually set admin session
            session(['admin_logged_in' => true, 'admin_email' => $email]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        // Check if admin is logged in via session
        if (!session()->has('admin_logged_in') || !session()->get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return view('layout.admin.account');
    }

    public function logout(Request $request)
    {
        // Clear admin session
        $request->session()->forget(['admin_logged_in', 'admin_email']);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
