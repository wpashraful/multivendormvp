<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ticket Price</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tickets</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($lotteries as $lottery)
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="font-medium text-gray-900">{{ $lottery->title }}</div>
                <div class="text-gray-500 text-sm">{{ $lottery->description }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-gray-900">${{ number_format($lottery->ticket_price, 2) }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="w-24 mr-2">
                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-green-500" style="width: {{ ($lottery->sold_tickets / $lottery->total_tickets * 100) }}%"></div>
                        </div>
                    </div>
                    <span>{{ $lottery->sold_tickets }}/{{ $lottery->total_tickets }}</span>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-gray-900">
                    @if($lottery->start_date && $lottery->end_date)
                        {{ $lottery->start_date->format('M j') }} - {{ $lottery->end_date->format('M j') }}
                    @else
                        Not set
                    @endif
                </div>
                @if($lottery->end_date && $lottery->end_date < now())
                    <div class="text-gray-500 text-sm">Expired</div>
                @elseif($lottery->end_date)
                    <div class="text-gray-500 text-sm">{{ $lottery->end_date->diffForHumans() }}</div>
                @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                @php
                    $colors = ['upcoming' => 'bg-blue-100 text-blue-800', 'active' => 'bg-green-100 text-green-800', 'completed' => 'bg-gray-100 text-gray-800', 'cancelled' => 'bg-red-100 text-red-800'];
                @endphp
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colors[$lottery->status ?? 'upcoming'] ?? 'bg-blue-100 text-blue-800' }}">
                    {{ ucfirst($lottery->status ?? 'upcoming') }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('lottery.show', $lottery->id) }}" class="p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('lottery.edit', $lottery->id) }}" class="p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('lottery.destroy', $lottery->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-red-600 hover:text-red-900 hover:bg-red-50 rounded"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($lotteries->hasPages())
<div class="bg-white px-4 py-3 border-t border-gray-200">
    {{ $lotteries->links() }}
</div>
@endif