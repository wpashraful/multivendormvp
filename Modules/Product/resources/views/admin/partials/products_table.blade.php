<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-200">
        <tr class="bg-gray-200 text-left">
            <th class="p-2 border">#</th>
            <th class="p-2 border">Name</th>
            <th class="p-2 border">Price</th>
            <th class="p-2 border">Stock</th>
            <th class="p-2 border">Status</th>
            <th class="p-2 border">Category</th>
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
                    <form class="inline" action="{{ route('products.updateStatus', $product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select class="w-full pl-4 pr-10 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="status" onchange="this.form.submit()">
                            <option value="1" {{ $product->status ? 'selected' : ''}}>Active</option>
                            <option value="0" {{ !$product->status ? 'selected' : ''}}>Inactive</option>
                        </select>
                    </form>
                </td>
                <td class="border p-2">{{ $product->category->name ?? 'No Category' }}</td>
                <td class="border p-2">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" width="50" alt="{{ $product->name }}">
                    @else
                        <span class="text-gray-400">No Image</span>
                    @endif
                </td>
                
                <td class="border p-2">
                    <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a> |
                    <a href="{{ route('product.lotteries.attach', $product->id) }}" class="bg-purple-600 text-white px-2 py-1 rounded hover:bg-purple-700 transition-colors text-sm">Attach Lotteries</a> |
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>  
                </td>
            </tr>
            <tr>
                <td colspan="8" class="bg-gray-50 p-2">
                    <strong>Attached Lotteries:</strong>
                    @if($product->lotteries->isEmpty())
                        <span class="text-gray-400">None</span>
                    @else
                        <ul class="list-disc pl-6">
                            @foreach($product->lotteries as $lottery)
                                <li>{{ $lottery->title }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center p-4 text-gray-500">No products found!</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination -->
<div class="mt-4">
    {{ $products->appends(request()->query())->links() }}
</div>