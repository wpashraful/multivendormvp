@extends('layouts.admin')

@section('title', 'Coupons')
@section('content')

    <div class="bg-gray-50 container mx-auto px-4 py-8 max-w-3xl">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">
                {{-- - Discount Code --}}
            </h1>
            
            @if ($errors->any())
                <div class="mb-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form class="space-y-6" method="POST" action="{{ route('coupon.store') }}">
                @csrf
                <!-- Code Field -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Code *</label>
                        <input type="text" id="code" name="code" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>
                </div>

                <!-- Discount Details -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="discount_amount" class="block text-sm font-medium text-gray-700 mb-1">Discount Amount</label>
                        <input type="number" step="0.01" id="discount_amount" name="discount_amount" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="discount_type" class="block text-sm font-medium text-gray-700 mb-1">Discount Type</label>
                        <select id="discount_type" name="discount_type" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="fixed">Fixed Amount</option>
                            <option value="percent">Percentage</option>
                        </select>
                    </div>
                </div>

                <!-- Validity Period -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="valid_from" class="block text-sm font-medium text-gray-700 mb-1">Valid From</label>
                        <input type="datetime-local" id="valid_from" name="valid_from" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="expires_at" class="block text-sm font-medium text-gray-700 mb-1">Expires At</label>
                        <input type="datetime-local" id="expires_at" name="expires_at" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Usage Limits -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="max_usage" class="block text-sm font-medium text-gray-700 mb-1">Max Usage</label>
                        <input type="number" id="max_usage" name="max_usage" value="1" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Status -->
                <div class="flex items-center">
                    <input type="checkbox" id="is_active" name="is_active" checked
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">Active</label>
                </div>

                <!-- Relationships -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="lottery_id" class="block text-sm font-medium text-gray-700 mb-1">Associated Lottery</label>
                        <select id="lottery_id" name="lottery_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Lottery (Optional)</option>
                            @foreach($lotteries as $lottery)
                                <option value="{{ $lottery->id }}">{{ $lottery->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Assigned User</label>
                        <select id="user_id" name="user_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">None</option>
                            <!-- Options would be populated dynamically -->
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <a href="{{ url()->previous() }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Save Discount Code
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection