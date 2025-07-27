@extends('layouts.admin')

@section('title', 'Category List')

@section('content')
    <h2 class="text-2xl font-bold mb-4">All Categories</h2>

    <a href="{{ route('categories.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mb-4 inline-block">+ Add Category</a>

    <table class="w-full bg-white rounded shadow">
        <thead class="bg-gray-200">
            <tr>
                <th class="text-left p-2">#</th>
                <th class="text-left p-2">Name</th>
                <th class="text-left p-2">Status</th>
                <th class="text-left p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $key => $category)
                <tr class="border-b">
                    <td class="p-2">{{ $key + 1 }}</td>
                    <td class="p-2">{{ $category->name }}</td>
                    <td class="p-2">
                        @if($category->status)
                            <span class="text-green-600 font-semibold">Active</span>
                        @else
                            <span class="text-red-600 font-semibold">Inactive</span>
                        @endif
                    </td>
                    <td class="p-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
