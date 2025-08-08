@extends('layouts.admin')

@section('title', 'Product List')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Products</h1>
        <div class="flex space-x-4">
            <form class="flex" method="GET" action="{{ route('products.index') }}">
                <!-- Search Input -->
                <input 
                    type="text" 
                    id="productSearch" 
                    name="search"
                    placeholder="Search products..." 
                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </form>
            <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition-colors">+ Add Product</a>
        </div>
    </div>
    
    <!-- Table Container -->
    <div id="productsTableContainer">
        @include('product::admin.partials.products_table', ['products' => $products])
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('productSearch');
    const productsContainer = document.getElementById('productsTableContainer');
    
    function handleSearch() {
        const searchTerm = searchInput.value.trim();
        const url = new URL('{{ route("products.index") }}');
        url.searchParams.append('search', searchTerm);
        
        // Show loading state
        productsContainer.innerHTML = '<div class="text-center py-8"><div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div><p class="mt-2 text-gray-600">Loading...</p></div>';
        
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
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
                    <p class="text-sm mt-1">Error details: ${error.message}</p>
                </div>
            `;
        });
    }
    
    // Debounced event listener
    let debounceTimer;
    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(handleSearch, 500);
    });
    
    // Also handle form submission to prevent page reload
    const searchForm = searchInput.closest('form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleSearch();
        });
    }
});
</script>