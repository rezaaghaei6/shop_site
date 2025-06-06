@extends('layouts.app')

@section('title', 'نتایج جستجو')

@section('content')
    <div class="container">
        <h2 class="mb-4">نتایج جستجو برای "{{ request('query') }}"</h2>

        @if($products->isEmpty())
            <p class="no-products">هیچ محصولی یافت نشد.</p>
        @else
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-image-wrapper">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}"
                                 alt="{{ $product->name }}"
                                 class="product-image">
                            @if($product->discount)
                                <span class="product-tag sale">تخفیف</span>
                            @elseif(!empty($product->is_new))
                                <span class="product-tag new">جدید</span>
                            @endif
                        </div>
                        <div class="product-content">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-price">
                                @if($product->discount)
                                    <span class="original-price">{{ number_format($product->price, 0) }} تومان</span>
                                    <span class="discounted-price">
                                        {{ number_format($product->price * (1 - $product->discount / 100), 0) }} تومان
                                    </span>
                                @else
                                    <span class="discounted-price">{{ number_format($product->price, 0) }} تومان</span>
                                @endif
                            </p>
                            <a href="{{ route('products.show', $product->id) }}" class="view-btn">مشاهده محصول</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
