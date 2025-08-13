@extends('layouts.admin')

@section('title', 'Lotteries')

@section('content')
<div class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="/lotteries/1" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Edit Lottery</h1>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <form class="p-6" action="{{ route('lottery.update', $lottery->id) }}" method="POST">
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
                <!-- Basic Information -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Basic Information</h2>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                            <input type="text" id="title" name="title" value="{{ $lottery->title }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="description" name="description" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $lottery->description }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Ticket Information -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Ticket Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="ticket_price" class="block text-sm font-medium text-gray-700 mb-1">Ticket Price *</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" step="0.01" id="ticket_price" name="ticket_price" value="{{ $lottery->ticket_price }}"
                                       class="block w-full pl-7 pr-12 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                       required>
                            </div>
                        </div>
                        <div>
                            <label for="total_tickets" class="block text-sm font-medium text-gray-700 mb-1">Total Tickets *</label>
                            <input type="number" id="total_tickets" name="total_tickets" value="{{ $lottery->total_tickets }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>
                        <div>
                            <label for="sold_tickets" class="block text-sm font-medium text-gray-700 mb-1">Sold Tickets</label>
                            <input type="number" id="sold_tickets" name="sold_tickets" value="{{ $lottery->sold_tickets }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Date Information -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Date Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                            <input type="datetime-local" id="start_date" name="start_date" value="{{ $lottery->start_date->format('Y-m-d\TH:i') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date *</label>
                            <input type="datetime-local" id="end_date" name="end_date" value="{{ $lottery->end_date->format('Y-m-d\TH:i') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Status</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="upcoming" {{ $lottery->status == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                <option value="active" {{ $lottery->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="completed" {{ $lottery->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $lottery->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between pt-6 border-t">
                    <div>
                        <button type="button" onclick="window.location.href='{{ route('lottery.index') }}'" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-times mr-2"></i> Cancel
                        </button>
                    </div>
                    <div class="flex space-x-3">
                        <button type="button" onclick="if(confirm('Are you sure you want to delete this lottery?')) { document.getElementById('delete-form').submit(); }" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="fas fa-trash mr-2"></i> Delete
                        </button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection