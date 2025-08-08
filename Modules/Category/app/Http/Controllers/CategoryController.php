<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Category\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category::admin.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'boolean',
        ], [
            'name.required' => 'Category name is required.',
            'name.unique' => 'A category with this name already exists.',
        ]);

        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $counter = 1;

        // Check if slug already exists and generate unique slug
        while (Category::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status ?? true,
        ]);

        return redirect()->route('category.index')
                        ->with('success', 'Category created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('category::admin.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category::admin.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'status' => 'boolean',
        ], [
            'name.required' => 'Category name is required.',
            'name.unique' => 'A category with this name already exists.',
        ]);

        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $counter = 1;

        // Check if slug already exists (excluding current category) and generate unique slug
        while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status ?? true,
        ]);

        return redirect()->route('category.index')
                        ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        
        return redirect()->route('category.index')
                        ->with('success', 'Category deleted successfully.');
    }
}
