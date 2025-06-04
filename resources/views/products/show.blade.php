@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container">
        <div class="product-details">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}" alt="{{ $product->name }}" class="product-image">
            <div class="details">
                <h1>{{ $product->name }}</h1>
                <p class="price">{{ number_format($product->price, 2) }} تومان</p>
                @if($product->discount)
                    <p class="discount">تخفیف: {{ $product->discount }}%</p>
                @endif
                <p>{{ $product->description }}</p>
                <p>دسته‌بندی: {{ $product->category->name }}</p>
                <p>موجودی: {{ $product->stock }}</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="cart-btn">افزودن به سبد خرید</button>
                </form>
            </div>
        </div>
    </div>
@endsection