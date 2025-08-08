@extends('layouts.admin')

@section('title', 'Attach Lotteries to Product')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Attach Lotteries to Product: {{ $product->name }}</h2>

    <form action="{{ route('product.lotteries.attach.store', $product->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="lottery_id" class="block font-semibold mb-2">Select Lottery</label>
            <select name="lottery_id" id="lottery_id" class="border rounded w-full p-2">
                @foreach($lotteries as $lottery)
                    <option value="{{ $lottery->id }}">{{ $lottery->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Attach Lottery</button>
    </form>

    <div class="mt-8">
        <h3 class="text-lg font-semibold mb-2">Attached Lotteries</h3>
        @if($attachedLotteries->isEmpty())
            <p class="text-gray-500">No lotteries attached to this product.</p>
        @else
            <ul class="list-disc pl-6">
                @foreach($attachedLotteries as $lottery)
                    <li>{{ $lottery->title }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="mt-6">
        <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline">&larr; Back to Products</a>
    </div>
</div>
@endsection
