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
                        <input type="text" id="search" placeholder="Search codes..." 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <label for="status" class="sr-only">Status</label>
                    <select id="status" class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="expired">Expired</option>
                    </select>
                </div>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors">
                    Filter
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Code
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Discount
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Validity
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Usage
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($coupons as $coupon)

                        
                        <!-- Sample Row 1 -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $coupon->code }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-gray-900">{{ $coupon->discount_amount }}%</div>
                                <div class="text-gray-500 text-sm">Percent discount</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">

                                <div>
                                    <div class="text-gray-500 text-sm">
                                        @php
                                            $isExpired = $coupon->expires_at->isPast();
                                        @endphp

                                        @if($isExpired)
                                            <span class="text-red-500">Expired</span>
                                        @else
                                            <span class="text-green-600">
                                                Expires in {{ $coupon->expires_at->diffForHumans(null,[
                                                    'parts' => 3,
                                                    'join' => ', ',
                                                ]) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                               
                               
                            </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-16 mr-2">
                                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                            @php
                                                // Calculate percentage (safe division)
                                                $used = $coupon->used_count ?? 0;
                                                $total = $coupon->max_usage ?? 1; // Prevent division by zero
                                                $percentage = min(100, max(0, ($used / $total) * 100));
                                                
                                                // Dynamic color based on usage
                                                $colorClass = 'bg-blue-500'; // Default
                                                if ($percentage > 80) {
                                                    $colorClass = 'bg-red-500';
                                                } elseif ($percentage > 50) {
                                                    $colorClass = 'bg-yellow-500';
                                                }
                                            @endphp
                                            <div class="h-full {{ $colorClass }}" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>
                                    <span>{{ $used }}/{{ $total }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('coupon.edit', $coupon->id) }}" class="text-blue-600 hover:text-blue-900">edit</a>
                                    <form action="{{ route('coupon.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this coupon?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No coupons found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>

            

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="w-full flex justify-center">
                    {{ $coupons->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection