<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Discount</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Validity</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usage</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($coupons as $coupon)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="font-medium text-gray-900">{{ $coupon->code }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-gray-900">{{ $coupon->discount_amount }}{{ $coupon->discount_type === 'percent' ? '%' : '$' }}</div>
                    <div class="text-gray-500 text-sm">{{ $coupon->discount_type === 'percent' ? 'Percent' : 'Fixed' }} discount</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-gray-500 text-sm">
                        @php $isExpired = $coupon->expires_at->isPast(); @endphp
                        @if($isExpired)
                            <span class="text-red-500">Expired</span>
                        @else
                            <span class="text-green-600">Expires in {{ $coupon->expires_at->diffForHumans() }}</span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="w-16 mr-2">
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                @php
                                    $used = $coupon->used_count ?? 0;
                                    $total = $coupon->max_usage ?? 1;
                                    $percentage = min(100, max(0, ($used / $total) * 100));
                                    $colorClass = $percentage > 80 ? 'bg-red-500' : ($percentage > 50 ? 'bg-yellow-500' : 'bg-blue-500');
                                @endphp
                                <div class="h-full {{ $colorClass }}" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                        <span>{{ $used }}/{{ $total }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @php
                        $isExpired = $coupon->expires_at && $coupon->expires_at->isPast();
                        $isActive = $coupon->is_active && !$isExpired;
                    @endphp
                    @if($isExpired)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Expired</span>
                    @elseif($isActive)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Inactive</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('coupon.show', $coupon->id) }}" class="text-blue-600 hover:text-blue-900">view</a>
                        <a href="{{ route('coupon.edit', $coupon->id) }}" class="text-blue-600 hover:text-blue-900">edit</a>
                        <form action="{{ route('coupon.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No coupons found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
    <div class="w-full flex justify-center">
        {{ $coupons->links('pagination::tailwind') }}
    </div>
</div>