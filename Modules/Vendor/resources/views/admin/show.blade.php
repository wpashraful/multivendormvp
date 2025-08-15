@extends('layouts.admin')
@section('title', 'Vendor Management')
@section('content')

<div class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="/vendors" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Vendor Details</h1>
        </div>

        <!-- Main Card -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Banner -->
            <div class="h-48 bg-gray-200 flex items-center justify-center">
                <img src="https://via.placeholder.com/1200x400" alt="Vendor banner" class="h-full w-full object-cover">
            </div>

            <!-- Vendor Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-20 w-20 -mt-12 border-4 border-white rounded-full bg-white">
                        <img class="h-full w-full rounded-full" src="https://via.placeholder.com/300" alt="Vendor logo">
                    </div>
                    <div class="ml-6 flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Tech Gadgets Inc.</h2>
                                <p class="text-gray-600">Electronics and gadgets</p>
                            </div>
                            <div class="flex space-x-2">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Approved
                                </span>
                                <a href="/vendors/1/edit" class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vendor Details -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Business Information -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Business Information</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Description</p>
                                <p class="font-medium">Leading provider of cutting-edge tech gadgets and electronics for modern lifestyles.</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Commission Rate</p>
                                <p class="font-medium">15%</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Joined On</p>
                                <p class="font-medium">June 12, 2023</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Contact Information</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium">contact@techgadgets.com</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Phone</p>
                                <p class="font-medium">+1 (555) 123-4567</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Address</p>
                                <p class="font-medium">123 Tech Street, Silicon Valley, CA 94025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="px-6 py-4 border-t border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Vendor Stats</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-lg shadow border border-gray-100">
                        <p class="text-sm text-gray-500">Total Products</p>
                        <p class="text-2xl font-bold">42</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow border border-gray-100">
                        <p class="text-sm text-gray-500">Total Sales</p>
                        <p class="text-2xl font-bold">$12,450</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow border border-gray-100">
                        <p class="text-sm text-gray-500">Commission Earned</p>
                        <p class="text-2xl font-bold">$1,867.50</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow border border-gray-100">
                        <p class="text-sm text-gray-500">Customer Rating</p>
                        <p class="text-2xl font-bold">4.8 <span class="text-yellow-500"><i class="fas fa-star"></i></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection