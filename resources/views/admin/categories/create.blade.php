@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Create New Category</h2>

    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4 bg-white p-4 rounded shadow">
        @csrf
        <div>
            <label class="block font-semibold mb-1">Category Name</label>
            <input type="text" name="name" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Save
        </button>
    </form>
@endsection
