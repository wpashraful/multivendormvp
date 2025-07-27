@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Create New Product</h2>
    <form action="{{ route('products.store') }}" method="POST" class="space-y-4 bg-white p-4 rounded shadow" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name" class="block font-semibold mb-1">Product Name</label>
            <input type="text" name="name" id="name" required
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
            <label for="price" class="block font-semibold mb-1">Price</label>
            <input type="number" name="price" id="price" required
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
            <label for="stock" class="block font-semibold mb-1">Stock</label>
            <input type="number" name="stock" id="stock" required
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
            <label for="status" class="block font-semibold mb-1">Status</label>
            <select name="status" id="status" required
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        
        <div>
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="image" class="block font-semibold mb-1">Product Image</label>
            <input type="file" name="image" id="image"
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>


        <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Create Product
        </button>
    </form>
@endsection
