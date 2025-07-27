<!-- resources/views/products/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Product List')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Products</h1>
        <div class="flex space-x-4">
            <!-- সার্চ ইনপুট -->
            <input 
                type="text" 
                id="productSearch" 
                placeholder="Search products..." 
                class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <a href="{{ route('products.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">+Add Product</a>
        </div>
    </div>
    
    <!-- টেবিল কন্টেইনার -->
    <div id="productsTableContainer">
        @include('admin.products.partials.products_table', ['products' => $products])
    </div>

    
@endsection

<!-- resources/views/products/index.blade.php এর নিচে -->
<script>
// সংশোধিত JavaScript কোড
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('productSearch');
    const productsContainer = document.getElementById('productsTableContainer');
    
    function handleSearch() {
        const searchTerm = searchInput.value.trim();
        const url = new URL('{{ route("products.index") }}');
        url.searchParams.append('search', searchTerm);
        
        // লোডিং স্টেট দেখান
        productsContainer.innerHTML = '<div class="text-center py-8">Loading...</div>';
        
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        })
        .then(html => {
            productsContainer.innerHTML = html;
        })
        .catch(error => {
            console.error('Error:', error);
            productsContainer.innerHTML = `
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                    <p>Error loading products. Please try again.</p>
                </div>
            `;
        });
    }
    
    // ডিবাউন্স সহ ইভেন্ট লিসেনার
    let debounceTimer;
    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(handleSearch, 500);
    });
});
</script>