@extends('layouts.app')

@section('title', 'صفحه اصلی')

@section('content')
    <div class="container">
        <div class="banner">
            <h1>به فروشگاه ایران خوش آمدید!</h1>
            <p>محصولات باکیفیت با بهترین قیمت‌ها</p>
            <a href="#">همین حالا خرید کنید</a>
        </div>

        <h2 class="products-title">محصولات ما</h2>
        <div class="products-grid">
            @forelse($products as $product)
                <div class="product-card">
                    <div class="image-placeholder">تصویر محصول (به‌زودی)</div>
                    <div class="content">
                        <h3>{{ $product->name }}</h3>
                        <p>قیمت: {{ number_format($product->price) }} تومان</p>
                        <p>موجودی: {{ $product->stock }}</p>
                        <p class="description">{{ $product->description ?? 'بدون توضیحات' }}</p>
                        <div class="buttons">
                            <a href="#" class="view-btn">مشاهده</a>
                            <a href="#" class="cart-btn">افزودن به سبد</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-products">محصولی یافت نشد. لطفاً از پنل مدیریت محصول اضافه کنید.</p>
            @endforelse
        </div>
    </div>
@endsection