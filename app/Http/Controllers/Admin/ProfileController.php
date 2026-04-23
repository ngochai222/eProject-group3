<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        // Manager profile from customer table
        $managerId = session('manager_id');
        if ($managerId) {
            $admin = DB::table('customer')->where('customer_id', $managerId)->first();
            // Map to expected fields
            if ($admin) {
                $admin->name   = $admin->customer_name;
                $admin->email  = $admin->customer_email;
                $admin->phone  = $admin->customer_phone;
                $admin->avatar = $admin->customer_avatar;
            }
        } else {
            $admin = DB::table('admin')->first();
        }
        return view('managers.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email',
            'phone'  => 'nullable|string|max:20',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $managerId = session('manager_id');

        if ($managerId) {
            // Update manager in customer table
            $data = [
                'customer_name'  => $request->name,
                'customer_email' => $request->email,
                'customer_phone' => $request->phone,
                'updated_at'     => now(),
            ];

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $name);
                $data['customer_avatar'] = $name;
            }

            if ($request->filled('password')) {
                $request->validate(['password' => 'min:6|confirmed']);
                $data['customer_password'] = bcrypt($request->password);
            }

            DB::table('customer')->where('customer_id', $managerId)->update($data);
            session(['manager_name' => $request->name, 'manager_email' => $request->email]);
        } else {
            // Superadmin update
            $data = [
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'updated_at' => now(),
            ];

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $name);
                $data['avatar'] = $name;
            }

            if ($request->filled('password')) {
                $request->validate(['password' => 'min:6|confirmed']);
                $data['password'] = bcrypt($request->password);
            }

            DB::table('admin')->where('id', 1)->update($data);
            session(['admin_email' => $request->email]);
        }

        return back()->with('success', 'Profile updated successfully.');
    }
}


