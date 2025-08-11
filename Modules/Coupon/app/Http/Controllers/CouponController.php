<?php

namespace Modules\Coupon\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Coupon\Models\Coupon;
use Modules\Lottery\Models\Lottery;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $coupons = Coupon::latest()->paginate(10);
        return view('coupon::admin.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coupon::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    
    public function store(Request $request) {

       

        // Validate and store the coupon
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255|unique:coupons,code',
            'discount_amount' => 'required|numeric|min:0',
            'valid_from' => 'required|date',
            'expires_at' => 'required|date|after:valid_from',
            'max_usage' => 'nullable|integer|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $coupons = Coupon::create([
            'code' => $request->input('code'),
            'discount_amount' => $request->input('discount_amount'),
            'valid_from' => $request->input('valid_from'),
            'expires_at' => $request->input('expires_at'),
            'max_usage' => $request->input('max_usage'),
        ]);

        return redirect()->route('coupon.index')->with('success', 'Coupon created successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupon::admin.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    

   public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $lotteries = \Modules\Lottery\Models\Lottery::all(); // or ->active()->get() if you have an active scope
        return view('coupon::admin.edit', compact('coupon', 'lotteries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $coupon = Coupon::findOrFail($id);

        // Validate and update the coupon
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255|unique:coupons,code,' . $coupon->id,
            'discount_amount' => 'required|numeric|min:0',
            'valid_from' => 'required|date',
            'expires_at' => 'required|date|after:valid_from',
            'max_usage' => 'nullable|integer|min:1',
            'discount_type' => 'required|in:fixed,percent',
            'lottery_id' => 'nullable|exists:lotteries,id',
        ]);
        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $coupon->update([
            'code' => $request->input('code'),
            'discount_amount' => $request->input('discount_amount'),
            'valid_from' => $request->input('valid_from'),
            'discount_type' => $request->input('discount_type', 'fixed'),
            'is_active' => $request->input('is_active', false),
            'expires_at' => $request->input('expires_at'),
            'used_count' => $request->input('used_count', 0),
            'max_usage' => $request->input('max_usage'),
            'lottery_id' => $request->input('lottery_id'),
            
        ]);

        return redirect()->route('coupon.index')->with('success', 'Coupon updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->route('coupon.index')->with('success', 'Coupon deleted successfully!');
    }
}
