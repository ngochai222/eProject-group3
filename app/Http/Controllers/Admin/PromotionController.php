<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = DB::table('promotion')->orderByDesc('created_at')->get();
        return view('managers.promotions.index', compact('promotions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pro_string'         => 'required|string|max:50|unique:promotion,pro_string',
            'pro_discount_type'  => 'required|in:Percentage,Fixed',
            'pro_discount_value' => 'required|numeric|min:0',
            'pro_start_date'     => 'required|date',
            'pro_end_date'       => 'required|date|after:pro_start_date',
        ]);

        DB::table('promotion')->insert([
            'pro_string'         => strtoupper($request->pro_string),
            'pro_discount_type'  => $request->pro_discount_type,
            'pro_discount_value' => $request->pro_discount_value,
            'pro_start_date'     => $request->pro_start_date,
            'pro_end_date'       => $request->pro_end_date,
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        return back()->with('success', 'Promotion created.');
    }

    public function destroy($id)
    {
        DB::table('promotion')->where('pro_id', $id)->delete();
        return back()->with('success', 'Promotion deleted.');
    }
}


