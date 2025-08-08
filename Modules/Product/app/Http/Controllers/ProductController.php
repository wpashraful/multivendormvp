<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Models\Product;
use Modules\Category\Models\Category;

use Illuminate\Support\Str;

class ProductController extends Controller
{

    // public function index(){

    //     return view('product::index');


    // }
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $products = Product::query()
        ->with('category')
        ->when($request->filled('search'), function($query) use ($request) {
            $search = $request->search;
            return $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('price', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('category', function($categoryQuery) use ($search) {
                      $categoryQuery->where('name', 'like', "%{$search}%");
                  });
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    
    if ($request->ajax()) {
        return view('product::admin.partials.products_table', compact('products'))->render();
    }

    return view('product::admin.index', compact('products'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product::admin.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:products,name',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'status' => 'boolean',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:2048',
    ]);

    $imagePath = $request->hasFile('image')
        ? $request->file('image')->store('products', 'public')
        : null;

    Product::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'status' => $request->status ?? true,
        'category_id' => $request->category_id,
        'image' => $imagePath,
    ]);

    return redirect()->route('products.index')
                     ->with('success', 'Product created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('product::admin.edit', [
            'product' => Product::findOrFail($id),
            'categories' => Category::all(),
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->status = $request->status;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product status updated successfully');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('products', 'public')
            : $product->image;

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status ?? true,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success','prroduct deleted successfully');
    }
}
