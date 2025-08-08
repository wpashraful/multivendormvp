<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductLotteryController extends Controller
{
    /**
     * Show the form to attach lotteries to a product.
     */
    public function attachForm($productId)
    {
        $product = \Modules\Product\Models\Product::findOrFail($productId);
        $lotteries = \Modules\Lottery\Models\Lottery::all();
        $attachedLotteries = $product->lotteries;
        return view('product::admin.attach_to_product', compact('product', 'lotteries', 'attachedLotteries'));
    }

    /**
     * Handle the attachment of a lottery to a product.
     */
    public function storeAttachment(\Illuminate\Http\Request $request, $productId)
    {
        $request->validate([
            'lottery_id' => 'required|exists:lotteries,id',
        ]);
        $product = \Modules\Product\Models\Product::findOrFail($productId);
        $product->lotteries()->attach($request->lottery_id);
        return redirect()->route('products.index')->with('success', 'Lottery attached to product successfully.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return response()->json([]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        return response()->json([]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        //

        return response()->json([]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        return response()->json([]);
    }
}
