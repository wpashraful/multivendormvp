@extends('layouts.admin')

@section('title', 'Coupons')
@section('content')

    <div class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Discount Codes</h1>
                <p class="text-gray-600">Manage your promotional codes and discounts</p>
            </div>
            <a href="{{ route('coupon.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i> Create New
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search codes..." 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <label for="status" class="sr-only">Status</label>
                    <select id="status" name="status" class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div id="coupon-table" class="bg-white shadow-sm rounded-lg overflow-hidden">
            @include('coupon::admin.partials.table', ['coupons' => $coupons])
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const statusSelect = document.getElementById('status');
    
    function performSearch() {
        const search = searchInput.value;
        const status = statusSelect.value;
        
        fetch(`{{ route('coupon.index') }}?search=${search}&status=${status}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('coupon-table').innerHTML = html;
        });
    }
    
    searchInput.addEventListener('input', performSearch);
    statusSelect.addEventListener('change', performSearch);
});
</script>
@endsection