@extends('layouts.admin')

@section('title', 'Lotteries')

@section('content')
    
    {{-- Lotteries Table or Empty State --}}
    @if(isset($lotteries) && count($lotteries) > 0)

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Lotteries</h2>
            <a href="{{ route('lottery.create') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create New Lottery</a>
        </div>
        <table class="min-w-full bg-white border border-gray-200 rounded mb-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Start Date</th>
                    <th class="py-2 px-4 border-b">End Date</th>
                    <th class="py-2 px-4 border-b">Active</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lotteries as $lottery)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $lottery->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $lottery->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $lottery->start_date }}</td>
                        <td class="py-2 px-4 border-b">{{ $lottery->end_date }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <form action="{{ route('lottery.updateStatus', $lottery->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <select name="is_active"
                                    class="pl-4 pr-10 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    onchange="this.form.submit()">
                                    <option value="1" {{ $lottery->is_active ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$lottery->is_active ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </form>
                        </td>
                        <td class="py-2 px-4 border-b flex gap-2">
                            {{-- Delete Button --}}
                            <form action="{{ route('lottery.destroy', $lottery->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this lottery?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mb-4">
            {{ $lotteries->links() }}
        </div>
        
    @else
        <div class="text-center text-gray-500 py-10">
            <svg class="mx-auto mb-4 w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2a4 4 0 004 4h2a4 4 0 004-4z" /></svg>
            <p>No lotteries found. Click "Create New Lottery" to create one.</p>
        </div>
        <div class="flex justify-center items-center mb-4">
        <a href="{{ route('lottery.create') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create New Lottery</a>
    </div>
    @endif
@endsection
