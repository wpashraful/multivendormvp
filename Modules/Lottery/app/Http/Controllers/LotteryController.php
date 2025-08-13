<?php

namespace Modules\Lottery\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Lottery\Models\Lottery;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LotteryController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch lotteries with pagination
        $lotteries = \Modules\Lottery\Models\Lottery::paginate(15);
        return view('lottery::admin.index', compact('lotteries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lottery::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ticket_price' => 'required|numeric|min:0',
            'total_tickets' => 'required|integer|min:1',
            'sold_tickets' => 'nullable|integer|min:0|lte:total_tickets',
            'start_date' => 'required| date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'product_id' => 'nullable|exists:products,id',
            'vendor_id' => 'nullable|exists:vendors,id',
            'status' => 'nullable|in:upcoming,active,completed,cancelled',
        ]);
        
        $validated['sold_tickets'] = $validated['sold_tickets'] ?? 0;
        $validated['created_by'] = auth()->id();
        
        // Ensure dates are properly formatted
        $validated['start_date'] = \Carbon\Carbon::parse($validated['start_date']);
        $validated['end_date'] = \Carbon\Carbon::parse($validated['end_date']);
        
        Lottery::create($validated);
        return redirect()->route('lottery.index')->with('success', 'Lottery created successfully.');
    }

    

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $lottery = Lottery::findOrFail($id);
        // Reminder: Ensure output is escaped in Blade views
        return view('lottery::admin.show', compact('lottery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lottery = Lottery::findOrFail($id);
        return view('lottery::admin.edit', compact('lottery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lottery = Lottery::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'ticket_price' => 'required|numeric|min:0',
            'total_tickets' => 'required|integer|min:1',
            'sold_tickets' => 'nullable|integer|min:0|lte:total_tickets',
            'product_id' => 'nullable|exists:products,id',
            'vendor_id' => 'nullable|exists:vendors,id',
            'status' => 'nullable|in:upcoming,active,completed,cancelled',
        ]);
        $validated['sold_tickets'] = $validated['sold_tickets'] ?? 0;
        $validated['is_active'] = $request->has('is_active');
        $lottery->update($validated);
        return redirect()->route('lottery.index')->with('success', 'Lottery updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $lottery = Lottery::findOrFail($id);
        // Simple validation
        $request->validate([
            'is_active' => 'required|boolean',
        ]);
        // Update the lottery status
        $lottery->is_active = $request->input('is_active');
        $lottery->save();
        return redirect()->route('lottery.index')->with('success', 'Lottery status updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $lottery = Lottery::findOrFail($id);
        $lottery->delete();
        return redirect()->route('lottery.index')->with('success', 'Lottery deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = Lottery::query();
        
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        $lotteries = $query->paginate(15);
        
        return view('lottery::admin.table', compact('lotteries'))->render();
    }
}
