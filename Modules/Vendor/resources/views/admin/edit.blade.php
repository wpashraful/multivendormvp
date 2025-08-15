@extends('layouts.admin')
@section('title', 'Vendor Management')
@section('content')

<div class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="{{ route('vendors.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Edit Vendor</h1>
        </div>
        <!-- Form Card -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <form class="p-6" action="{{ route('vendors.update', $vendor->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Business Information -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Business Information</h2>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="business_name" class="block text-sm font-medium text-gray-700 mb-1">Business Name *</label>
                            <input type="text" id="business_name" name="business_name" value="{{ old('business_name', $vendor->business_name) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>
                        <div>
                            <label for="business_description" class="block text-sm font-medium text-gray-700 mb-1">Business Description</label>
                            <textarea id="business_description" name="business_description" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('business_description', $vendor->business_description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Contact Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="business_email" class="block text-sm font-medium text-gray-700 mb-1">Business Email *</label>
                            <input type="email" id="business_email" name="business_email" value="{{ old('business_email', $vendor->business_email) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>
                        <div>
                            <label for="business_phone" class="block text-sm font-medium text-gray-700 mb-1">Business Phone</label>
                            <input type="tel" id="business_phone" name="business_phone" value="{{ old('business_phone', $vendor->business_phone) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label for="business_address" class="block text-sm font-medium text-gray-700 mb-1">Business Address</label>
                            <textarea id="business_address" name="business_address" rows="2"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('business_address', $vendor->business_address) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Media & Commission -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Media & Commission</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="logo_url" class="block text-sm font-medium text-gray-700 mb-1">Logo URL</label>
                            <input type="url" id="logo_url" name="logo_url" value="{{ old('logo_url', $vendor->logo_url) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @if($vendor->logo_url)
                            <div class="mt-2">
                                <img src="{{ $vendor->logo_url }}" alt="Current logo" class="h-16 w-16 rounded-full object-cover">
                            </div>
                            @endif
                        </div>
                        <div>
                            <label for="banner_url" class="block text-sm font-medium text-gray-700 mb-1">Banner URL</label>
                            <input type="url" id="banner_url" name="banner_url" value="{{ old('banner_url', $vendor->banner_url) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @if($vendor->banner_url)
                            <div class="mt-2">
                                <img src="{{ $vendor->banner_url }}" alt="Current banner" class="h-16 w-full object-cover rounded">
                            </div>
                            @endif
                        </div>
                        <div>
                            <label for="commission_rate" class="block text-sm font-medium text-gray-700 mb-1">Commission Rate (%) *</label>
                            <div class="relative rounded-md shadow-sm">
                                <input type="number" step="0.01" id="commission_rate" name="commission_rate" value="{{ old('commission_rate', $vendor->commission_rate) }}"
                                       class="block w-full pr-12 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Status</h2>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Vendor Status *</label>
                        <select id="status" name="status" 
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required>
                            <option value="pending" {{ old('status', $vendor->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('status', $vendor->status) === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status', $vendor->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="suspended" {{ old('status', $vendor->status) === 'suspended' ? 'selected' : '' }}>Suspended</option>
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between pt-6 border-t">
                    <div>
                        <button type="button" onclick="window.location.href='{{ route('vendors.index') }}'" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-times mr-2"></i> Cancel
                        </button>
                    </div>
                    <div class="flex space-x-3">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>
                    </div>
                </div>
            </form>

            <!-- Delete form moved outside the update form -->
            <div class="flex justify-end p-6 border-t">
                <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this vendor?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-2"></i> Delete
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
