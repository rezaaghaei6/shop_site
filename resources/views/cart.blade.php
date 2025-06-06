@extends('layouts.app')

@section('title', 'سبد خرید')

@section('content')
<style>
    body {
        font-family: 'Vazirmatn', sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 960px;
        margin: 40px auto;
        background-color: #fff;
        border-radius: 12px;
        padding: 30px 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
    }

    h1 {
        font-size: 1.8rem;
        color: #333;
        margin-bottom: 30px;
        text-align: center;
        font-weight: 600;
    }

    .cart-item {
        display: flex;
        gap: 20px;
        border-bottom: 1px solid #eee;
        padding: 20px 0;
        align-items: flex-start;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item img {
        width: 100px;
        height: auto;
        border-radius: 8px;
        object-fit: cover;
    }

    .cart-item-details {
        flex: 1;
    }

    .cart-item-details h4 {
        margin-bottom: 8px;
        color: #222;
        font-size: 1.1rem;
    }

    .cart-item-details p {
        margin: 4px 0;
        color: #666;
        font-size: 0.95rem;
    }

    .cart-item form {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }

    .cart-item input[type="number"] {
        width: 70px;
        padding: 5px;
        font-size: 0.95rem;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .btn {
        padding: 6px 14px;
        font-size: 0.9rem;
        border-radius: 6px;
        border: none;
        transition: 0.3s ease;
    }

    .btn-primary {
        background-color: #3498db;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: #fff;
        margin-top: 8px;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .cart-summary {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid #eee;
        text-align: center;
    }

    .cart-summary h3 {
        font-size: 1.4rem;
        color: #27ae60;
        margin-bottom: 20px;
    }

    .btn-success {
        background-color: #2ecc71;
        color: #fff;
    }

    .btn-success:hover {
        background-color: #27ae60;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    @media (max-width: 768px) {
        .cart-item {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .cart-item img {
            margin-bottom: 10px;
        }

        .cart-item form {
            justify-content: center;
        }
    }
</style>

<div class="container">
    <h1>سبد خرید شما</h1>

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if($cartItems->isNotEmpty())
        @php $cartTotal = 0; @endphp
        @foreach($cartItems as $item)
            @php
                $product = $item->product;
                $unitPrice = $product->price * (1 - ($product->discount ?? 0) / 100);
                $subtotal = $unitPrice * $item->quantity;
                $cartTotal += $subtotal;
            @endphp

            <div class="cart-item">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}"
                     alt="{{ $product->name }}">
                <div class="cart-item-details">
                    <h4>{{ $product->name }}</h4>
                    <p>قیمت واحد: {{ number_format($unitPrice, 0) }} تومان</p>
                    <p>جمع: {{ number_format($subtotal, 0) }} تومان</p>

                    <form action="{{ route('cart.update', $product->id) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                        <button type="submit" class="btn btn-primary">به‌روزرسانی</button>
                    </form>

                    <a href="{{ route('cart.remove', $product->id) }}" class="btn btn-danger">حذف</a>
                </div>
            </div>
        @endforeach

        <div class="cart-summary">
            <h3>جمع کل: {{ number_format($cartTotal, 0) }} تومان</h3>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">ثبت سفارش</button>
            </form>
        </div>
    @else
        <p class="text-center">سبد خرید شما خالی است.</p>
    @endif
</div>
@endsection
