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
        
        // Validation (consider moving to FormRequest for best practice)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        // Convert checkbox to boolean
        $validated['is_active'] = $request->has('is_active');
        // Ensure $fillable is set in Lottery model to prevent mass assignment vulnerabilities
        Lottery::create($validated + [
            'created_by' => auth()->id()
        ]);
        return redirect()->route('lottery.index')->with('success', 'Lottery created successfully.');
    }

    

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $lottery = Lottery::findOrFail($id);
        // Reminder: Ensure output is escaped in Blade views
        return view('lottery::show', compact('lottery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lottery = Lottery::findOrFail($id);
        $this->authorize('update', $lottery);
        return view('lottery::edit', compact('lottery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lottery = Lottery::findOrFail($id);
        $this->authorize('update', $lottery);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
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
}
