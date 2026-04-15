<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class ForgotpwController extends Controller
{
    public function showForgotForm()
    {
        return view('layout.customer.forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $customer = Customer::where('customer_email', $request->email)->first();

        if (! $customer) {
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
        }

        return back()->with('status', 'Yêu cầu đặt lại mật khẩu đã được gửi.');
    }
}