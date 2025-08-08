@extends('layouts.admin')

@section('title', 'Create Lottery Coupon')

@section('content')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Create Lottery Coupon</h1>
    </div>

    <form action="{{ route('lottery.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Lottery Title</label>
            <input type="text" id="lottery_title" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Lottery Description</label>
            <textarea id="lottery_description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
        </div>
        <div class="mb-4">
            <label for="start_date" class="block text-sm font-medium text-gray-700">Lottery Start Date</label>
            <input type="datetime-local" id="lottery_start_date" name="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="end_date" class="block text-sm font-medium text-gray-700">Lottery End Date</label>
            <input type="datetime-local" id="lottery_end_date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <!-- is_active -->
        <div class="flex items-center mb-4">
            <input type="checkbox" name="is_active" id="is_active" 
       {{ old('is_active', true) ? 'checked' : '' }}>
            <label for="is_active" class="ml-2 block text-sm text-gray-900">Active Lottery</label>
          </div>
        
        <!-- submit button -->
        
        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Create Coupon
        </button>
    </form>

@endsection