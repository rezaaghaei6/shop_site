@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row gap-6 items-start">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}" alt="{{ $product->name }}" class="w-full md:w-1/2 rounded-lg shadow-md">
            <div class="md:w-1/2 space-y-4">
                <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
                <p class="text-xl text-green-600">{{ number_format($product->price, 2) }} تومان</p>
                @if($product->discount)
                    <p class="text-red-500">تخفیف: {{ $product->discount }}%</p>
                @endif
                <p>{{ $product->description }}</p>
                <p>دسته‌بندی: <strong>{{ $product->category->name }}</strong></p>
                <p>موجودی: {{ $product->stock }}</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">افزودن به سبد خرید</button>
                </form>
            </div>
        </div>
    </div>
@endsection
