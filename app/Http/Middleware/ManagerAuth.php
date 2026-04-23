<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ManagerAuth
{
    // Các module và route pattern tương ứng
    const MODULE_ROUTES = [
        'movies'     => 'managers/movies*',
        'showtimes'  => 'managers/showtimes*',
        'cinemas'    => 'managers/cinemas*',
        'seats'      => 'managers/seats*',
        'tickets'    => 'managers/tickets*',
        'reviews'    => 'managers/reviews*',
        'customers'  => 'managers/customers*',
        'pricing'    => 'managers/pricing*',
        'promotions' => 'managers/promotions*',
    ];

    public function handle(Request $request, Closure $next)
    {
        // Superadmin bypass
        if (session('role') === 'admin' || session('admin_logged_in')) {
            return $next($request);
        }

        // Manager check
        if (session('role') !== 'manager') {
            return redirect()->route('login');
        }

        // Always fetch fresh permissions from DB
        $managerId = session('manager_id');
        $manager = \DB::table('customer')->where('customer_id', $managerId)->where('role', 'manager')->where('is_active', 1)->first();

        if (!$manager) {
            session()->flush();
            return redirect()->route('login')->withErrors(['username' => 'Account deactivated.']);
        }

        $permissions = $manager->permissions;
        if (is_string($permissions)) {
            $permissions = json_decode($permissions, true);
            // Handle double-encoded JSON
            if (is_string($permissions)) {
                $permissions = json_decode($permissions, true);
            }
        }
        $permissions = (array)($permissions ?? []);

        // Update session with latest permissions
        session(['manager_permissions' => $permissions]);

        $path = $request->path();

        // Dashboard always allowed
        if ($path === 'managers/dashboard') {
            return $next($request);
        }

        // Check permission for current route
        foreach (self::MODULE_ROUTES as $module => $pattern) {
            if (fnmatch($pattern, $path)) {
                if (!in_array($module, $permissions)) {
                    abort(403, 'Access denied. You do not have permission for this module.');
                }
                break;
            }
        }

        return $next($request);
    }
}
