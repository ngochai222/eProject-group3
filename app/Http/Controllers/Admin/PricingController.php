<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PricingController extends Controller
{
    public function index()
    {
        $pricing = DB::table('pricing')->orderBy('day_of_week')->get();
        return view('admin.pricing.index', compact('pricing'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'prices'   => 'required|array',
            'prices.*' => 'numeric|min:0',
            'surcharge_percent'   => 'required|array',
            'surcharge_percent.*' => 'numeric|min:0|max:500',
        ]);

        foreach ($request->surcharge_percent as $id => $percent) {
            DB::table('pricing')->where('id', $id)->update([
                'base_price'        => $request->prices[$id] ?? 10,
                'surcharge_percent' => $percent,
                'updated_at'        => now(),
            ]);
        }

        return back()->with('success', 'Pricing updated successfully.');
    }

    // Helper: get price for a given date
    public static function getPriceForDate($date, $movieBasePrice = null)
    {
        $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeek;
        $pricing = DB::table('pricing')->where('day_of_week', $dayOfWeek)->first();

        $base = $movieBasePrice ?? ($pricing->base_price ?? 10.00);
        $surcharge = $pricing->surcharge_percent ?? 0;

        return round($base * (1 + $surcharge / 100), 2);
    }
}
