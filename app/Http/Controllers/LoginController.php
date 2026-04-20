<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLogin() {
        return view('layout.customer.login');
    }

    public function login(Request $request) {
    $credentials = $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    $remember = $request->has('remember');

    // Admin hardcoded check
    if ($credentials['username'] === 'admin@gmail.com' && $credentials['password'] === '123456') {
        session(['admin_logged_in' => true, 'admin_email' => $credentials['username']]);
        return redirect()->route('admin.dashboard');
    }

    if (Auth::guard('customer')->attempt(['customer_email' => $credentials['username'], 'password' => $credentials['password']], $remember)) {
        $request->session()->regenerate();
        return redirect()->route('home')->with('success', 'Welcome back!');
    }

    Log::warning('Login attempt failed:', [
        'email' => $credentials['username'],
    ]);

    return back()->withErrors([
        'username' => 'Thông tin đăng nhập không chính xác.',
    ]);
}

    public function logout(Request $request) {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
