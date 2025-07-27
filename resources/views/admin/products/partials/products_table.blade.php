<!-- resources/views/products/partials/products_table.blade.php -->
<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-200">
        <tr class="bg-gray-200 text-left">
            <th class="p-2 border">#</th>
            <th class="p-2 border">Name</th>
            <th class="p-2 border">Price</th>
            <th class="p-2 border">stock</th>
            <th class="p-2 border">status</th>
            <th class="p-2 border">category</th>
            <th class="p-2 border">Image</th>
            <th class="p-2 border">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
            <tr>
                <td class="border p-2">{{ $product->id }}</td>
                <td class="border p-2">{{ $product->name }}</td>
                <td class="border p-2">{{ $product->price }}</td>
                <td class="border p-2">{{ $product->stock }}</td>
                <td class="p-2 border">
                    <form class="inline" action="{{route('products.updateStatus', $product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select class="w-full pl-4 pr-10 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="status" onchange="this.form.submit()">
                            <option value="1" {{ $product->status ? 'selected' : ''}}>Active</option>
                            <option value="0" {{ !$product->status ? 'selected' : ''}}>Inactive</option>
                        </select>
                    </form>
                </td>
                <td class="border p-2">{{ $product->category->name }}</td>
                <td class="border p-2">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" width="50">
                    @else
                        <span class="text-gray-400">No Image</span>
                    @endif
                </td>
                <td class="border p-2">
                    <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600">Edit</a> |
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>  
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center p-4 text-gray-500">No products found!</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- পেজিনেশন -->
<div class="mt-4">
    {{ $products->links() }}
</div>