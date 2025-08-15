<?php

namespace Modules\Vendor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Vendor\Models\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::paginate(10);
        return view('vendor::admin.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('vendor::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $data = $request->validate([
            'business_name' => 'required|string|max:255',
            'business_email' => 'required|email|unique:vendors,business_email',
            'business_phone' => 'nullable|string|max:20',
            'business_address' => 'nullable|string',
            'logo_url' => 'nullable|url',
            'banner_url' => 'nullable|url',
            'business_description' => 'nullable|string',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:pending,approved,rejected,suspended'
        ]);
        $data['user_id'] = auth()->id();
        Vendor::create($data);
        return redirect()->route('vendors.index');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('vendor::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $vendor = Vendor::findOrFail($id);
        return view('vendor::admin.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $vendor = Vendor::findOrFail($id);
        $data = $request->validate([
            'business_name' => 'required|string|max:255',
            'business_email' => 'required|email|unique:vendors,business_email,'.$vendor->id,
            'business_phone' => 'nullable|string|max:20',
            'business_address' => 'nullable|string',
            'logo_url' => 'nullable|url',
            'banner_url' => 'nullable|url',
            'business_description' => 'nullable|string',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:pending,approved,rejected,suspended'
        ]);
        $vendor->update($data);
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();
        return redirect()->route('vendors.index');
    }
}
