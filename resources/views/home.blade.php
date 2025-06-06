@extends('layouts.app')

@section('title', 'فروشگاه آنلاین')

@section('content')
<style>
    .home-page {
        text-align: center;
        padding: 60px 0 30px;
    }

    .home-page h1 {
        font-size: 32px;
        margin-bottom: 10px;
    }

    .home-page p {
        font-size: 18px;
        color: #555;
    }

    .cta-button {
        margin-top: 20px;
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 10px 24px;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .cta-button:hover {
        background-color: #0056b3;
    }

    .products-section {
        margin-top: 40px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .product-card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.3s ease;
    }

    .product-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .product-image-wrapper {
        padding: 12px;
        background-color: #f8f9fa;
        text-align: center;
    }

    .product-image {
        max-width: 100%;
        height: auto;
    }

    .product-content {
        padding: 16px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .product-price {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .original-price {
        text-decoration: line-through;
        color: #999;
        margin-left: 10px;
    }

    .discounted-price {
        color: #28a745;
        font-weight: bold;
    }

    .product-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 12px;
        min-height: 45px;
    }

    .product-buttons {
        display: flex;
        gap: 10px;
    }

    .view-btn, .cart-btn {
        flex: 1;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    .view-btn {
        background-color: #007bff;
        color: white;
    }

    .view-btn:hover {
        background-color: #0056b3;
    }

    .cart-btn {
        background-color: #ffc107;
        color: black;
    }

    .cart-btn:hover {
        background-color: #e0a800;
    }

    @media (max-width: 992px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .products-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container">
    <div class="home-page">
        <h1>به فروشگاه ایران خوش آمدید!</h1>
        <p>محصولات باکیفیت با بهترین قیمت‌ها</p>
        <a href="{{ route('products') }}" class="cta-button">همین حالا خرید کنید</a>
    </div>

    <section class="products-section">
        <h2>محصولات</h2>

        @if($products->isEmpty())
            <p class="no-products">محصولی یافت نشد.</p>
        @else
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-image-wrapper">
                            <img 
                                src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}" 
                                alt="{{ $product->name }}" 
                                class="product-image"
                            >
                        </div>

                        <div class="product-content">
                            <h3 class="product-title">{{ $product->name }}</h3>

                            <p class="product-price">
                                @if($product->discount)
                                    <span class="original-price">{{ number_format($product->price, 0) }} تومان</span>
                                    <span class="discounted-price">{{ number_format($product->price * (1 - $product->discount / 100), 0) }} تومان</span>
                                @else
                                    <span class="discounted-price">{{ number_format($product->price, 0) }} تومان</span>
                                @endif
                            </p>

                            <p class="product-description">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</p>

                            <div class="product-buttons">
                                <a href="{{ route('products') }}" class="view-btn">مشاهده</a>

                                <form action="{{ route('cart.store') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="cart-btn">افزودن</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection
