@extends('layouts.admin')

@section('title', 'Edit Category')
@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Category</h2>

    <form>
        
    </form>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4 bg-white p-4 rounded shadow">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-semibold mb-1">Category Name</label>
            <input type="text" name="name" value="{{ old('name', $category ->name) }}" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
            <label class="block font-semibold mb-1">Status</label>
            <select name="status" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="1" {{ $category->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$category->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Category</button>
        </div>
    </form>
@endsection