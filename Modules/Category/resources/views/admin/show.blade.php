@extends('layouts.admin')

@section('title', 'Category Details')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Category Details</h1>
        <div class="space-x-4">
            <a href="{{ route('category.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to Categories</a>
            <a href="{{ route('category.edit', $category->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Category</a>
        </div>
    </div>

    <div class="bg-white rounded shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">Category Information</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name:</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $category->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Slug:</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $category->slug }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status:</label>
                        <p class="mt-1">
                            @if($category->status)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Inactive
                                </span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Created:</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $category->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Updated:</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $category->updated_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-4">Products in this Category</h3>
                @if($category->products->count() > 0)
                    <div class="space-y-2">
                        @foreach($category->products as $product)
                            <div class="border rounded p-3">
                                <h4 class="font-medium">{{ $product->name }}</h4>
                                <p class="text-sm text-gray-600">Price: ${{ $product->price }}</p>
                                <p class="text-sm text-gray-600">Stock: {{ $product->stock }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No products in this category yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection 