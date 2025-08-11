@extends('layouts.admin')

@section('title', 'Discount Code Details')
@section('content')
<div class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header with back button -->
        <div class="flex items-center mb-6">
            <a href="#" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Discount Code Details</h1>
        </div>

        <!-- Main card -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Card header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-medium text-gray-900">{{ $coupon->code }}</h2>
                    <div class="flex items-center mt-1">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Active
                        </span>
                        <span class="ml-2 text-sm text-gray-500">Created on {{ $coupon->created_at->format('F j, Y') }}</span>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('coupon.edit', $coupon->id) }}" class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('coupon.destroy', $coupon->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-md text-sm hover:bg-red-700 transition-colors">
                            <i class="fas fa-trash mr-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Card body -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Discount Details -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Discount Details</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Discount Type</p>
                                <p class="font-medium">{{ $coupon->discount_type === 'percent' ? 'Percentage' : 'Fixed Amount' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Discount Amount</p>
                                <p class="font-medium">{{ $coupon->discount_amount }}{{ $coupon->discount_type === 'percent' ? '%' : '$' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Validity Period -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Validity Period</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Valid From</p>
                                <p class="font-medium">{{ $coupon->valid_from->format('F j, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Expires At</p>
                                <p class="font-medium">{{ $coupon->expires_at->format('F j, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Time Remaining</p>
                                <p class="font-medium text-green-600">{{ $coupon->expires_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Usage Information -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Usage Information</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Max Usage</p>
                                <p class="font-medium">{{ $coupon->max_usage }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Times Used</p>
                                <div class="flex items-center">
                                    <div class="w-full mr-4">
                                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-blue-500" style="width: 45%"></div>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium">{{ $coupon->used_count }}/{{ $coupon->max_usage }}</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Last Used</p>
                                <p class="font-medium">{{ $coupon->last_used_at ? $coupon->last_used_at->format('F j, Y \a\t g:i A') : 'Never' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Relationships -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Relationships</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Associated Lottery</p>
                                <p class="font-medium">{{ $coupon->lottery->title ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Assigned User</p>
                                <p class="font-medium">{{ $coupon->user->name ?? 'N/A' }} ({{ $coupon->user->email ?? 'N/A' }})</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Log -->
            <div class="px-6 py-4 border-t border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Activity Log</h3>
                <div class="space-y-4">
                    <div class="flex">
                        <div class="flex-shrink-0 mr-3">
                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Code was created</p>
                            <p class="text-sm text-gray-500">June 1, 2023 at 10:30 AM by Admin User</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 mr-3">
                            <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-green-600"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Code was used by customer</p>
                            <p class="text-sm text-gray-500">June 15, 2023 at 2:45 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection