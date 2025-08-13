@extends('layouts.admin')

@section('title', 'view lottery')

@section('content')

    <div class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="{{ route('lottery.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Lottery Details</h1>
        </div>

        <!-- Main Card -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-medium text-gray-900">{{ $lottery->title }}</h2>
                    <div class="flex items-center mt-1">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Active
                        </span>
                        <span class="ml-2 text-sm text-gray-500">Created on {{ $lottery->created_at->format('F j, Y') }}</span>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('lottery.edit', $lottery->id) }}" class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('lottery.destroy', $lottery->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lottery?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-md text-sm hover:bg-red-700 transition-colors">
                            <i class="fas fa-trash mr-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Basic Information</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Description</p>
                                <p class="font-medium">{{ $lottery->description }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Created By</p>
                                <p class="font-medium">{{ $lottery->user->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket Information -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Ticket Information</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Ticket Price</p>
                                <p class="font-medium">{{ $lottery->ticket_price }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tickets Sold</p>
                                <div class="flex items-center">
                                    <div class="w-full mr-4">
                                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-green-500" style="width: {{ $lottery->total_tickets > 0 ? ($lottery->sold_tickets / $lottery->total_tickets * 100) : 0 }}%"></div>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium">{{ $lottery->sold_tickets }}/{{ $lottery->total_tickets }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Date Information -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Date Information</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Start Date</p>
                                <p class="font-medium">{{ $lottery->start_date->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">End Date</p>
                                <p class="font-medium">{{ $lottery->end_date->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Time Remaining</p>
                                <p class="font-medium text-green-600">{{ $lottery->end_date->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Associated Items -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Associated Items</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Product</p>
                                @if($lottery->products->isEmpty())
                                    <p class="font-medium text-gray-400">No products attached</p>
                                @else
                                    <ul class="font-medium">
                                        @foreach($lottery->products as $product)
                                            <li>{{ $product->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Vendor</p>
                                <p class="font-medium">Travel Paradise Inc.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Log -->
            <div class="px-6 py-4 border-t border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    <div class="flex">
                        <div class="flex-shrink-0 mr-3">
                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Lottery was created</p>
                            <p class="text-sm text-gray-500">{{ $lottery->created_at->format('F j, Y \a\t g:i A') }} by {{{ $lottery->user->name }}}</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 mr-3">
                            <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-ticket-alt text-green-600"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium">{{ $lottery->sold_tickets }} tickets sold</p>
                            <p class="text-sm text-gray-500">June 15, 2023 at 2:45 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection