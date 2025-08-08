@extends('layouts.admin');

@section('title', 'Edit Product')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4 bg-white p-4 rounded shadow" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="block font-semibold mb-1">Product Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
            <label for="price" class="block font-semibold mb-1">Price</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
            <label for="stock" class="block font-semibold mb-1">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
            <label for="status" class="block font-semibold mb-1">Status</label>
            <select name="status" id="status" required
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="1" {{ $product->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$product->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div>
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="image" class="block font-semibold mb-1">Product Image</label>
            <input type="file" name="image" id="image"
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" width="100" class="mt-2">
            @endif
        </div>
        <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Update Product
        </button>
    </form>
@endsection
