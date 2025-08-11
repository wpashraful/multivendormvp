@extends('layouts.admin')

@section('title', 'Edit Discount Code')
@section('content')
<div class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <!-- Header with breadcrumb -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400"></i>
                            <a href="#" class="ml-1 text-sm font-medium text-gray-600 hover:text-gray-900 md:ml-2">Discount Codes</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ 'Edit ' . $coupon->code }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-2xl font-bold text-gray-800 mt-2">Edit Discount Code</h1>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <form class="p-6" action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Code & Status -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-6">
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Code *</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" id="code" name="code" value="{{ $coupon->code }}" 
                                   class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2 px-3 border"
                                   required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm" id="price-currency">
                                    <i class="fas fa-tag"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $coupon->is_active ? 'Active' : 'Inactive' }}</label>
                        <div class="mt-1 flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" {{ $coupon->is_active ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-700">{{ $coupon->is_active ? 'Active' : 'Inactive' }}</label>
                        </div>
                    </div>
                </div>

                <!-- Discount Details -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-6">
                    <div>
                        <label for="discount_amount" class="block text-sm font-medium text-gray-700 mb-1">Discount Amount *</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="number" step="0.01" id="discount_amount" name="discount_amount" value="{{ $coupon->discount_amount }}"
                                   class="block w-full pr-12 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2 px-3 border"
                                   required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm" id="amount-symbol">
                                    {{ $coupon->discount_type === 'percent' ? '%' : '$' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="discount_type" class="block text-sm font-medium text-gray-700 mb-1">Discount Type *</label>
                        <select id="discount_type" name="discount_type" 
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="percent" {{ old('discount_type', $coupon->discount_type) === 'percent' ? 'selected' : '' }}>Percentage</option>
                            <option value="fixed" {{ old('discount_type', $coupon->discount_type) === 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                        </select>
                    </div>
                </div>

                <!-- Validity Period -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-6">
                    <div>
                        <label for="valid_from" class="block text-sm font-medium text-gray-700 mb-1">Valid From</label>
                        <input type="datetime-local" id="valid_from" name="valid_from" value="{{ $coupon->valid_from }}"
                               class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="expires_at" class="block text-sm font-medium text-gray-700 mb-1">Expires At</label>
                        <input type="datetime-local" id="expires_at" name="expires_at" value="{{ $coupon->expires_at }}"
                               class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>

                <!-- Usage Limits -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-6">
                    <div>
                        <label for="max_usage" class="block text-sm font-medium text-gray-700 mb-1">Max Usage</label>
                        <input type="number" id="max_usage" name="max_usage" value="{{ $coupon->max_usage }}"
                               class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="used_count" class="block text-sm font-medium text-gray-700 mb-1">Used Count</label>
                        <input type="number" id="used_count" name="used_count" value="{{ $coupon->used_count }}" 
                               class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-300ounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>

                <!-- Relationships -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-6">
                    <div>

               
                        <label for="lottery_id" class="block text-sm font-medium text-gray-700 mb-1">Associated Lottery</label>
                        <select id="lottery_id" name="lottery_id" 
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="{{ $coupon->lottery_id }}">{{ $coupon->lottery ? $coupon->lottery->title : '' }}</option>
                            @foreach($lotteries as $lottery)
                                 <option value="{{ $lottery->id }}" {{ $coupon->lottery_id == $lottery->id ? 'selected' : '' }}>{{ $lottery->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Assigned User</label>
                        <select id="user_id" name="user_id" 
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">None</option>
                            <option value="1">John Doe (john@example.com)</option>
                            <option value="2" selected>Jane Smith (jane@example.com)</option>
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between pt-6 border-t">
                    <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>
                    </form>
                    <a href="{{ route('coupon.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Dynamic discount type symbol changer
        const discountType = document.getElementById('discount_type');
        const amountSymbol = document.getElementById('amount-symbol');
        
        discountType.addEventListener('change', function() {
            amountSymbol.textContent = this.value === 'percent' ? '%' : '$';
        });
    </script>
</div>
@endsection