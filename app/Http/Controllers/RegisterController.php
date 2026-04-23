<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('layout.customer.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|unique:customer,customer_email',
            'customer_password' => 'required|confirmed|min:6',
            'customer_gender' => 'required|in:Male,Female,Other',
            'customer_date_of_birth' => 'required|date|before:today',
            'customer_phone' => 'required|string|max:20',
        ]);

        Customer::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_password' => Hash::make($request->customer_password),
            'customer_gender' => $request->customer_gender,
            'customer_date_of_birth' => $request->customer_date_of_birth,
            'customer_phone' => $request->customer_phone,
            'customer_address' =>  '',
            'customer_avatar' => '',
            'customer_favorite' => '',
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }
}

