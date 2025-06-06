@extends('layouts.app')

@section('title', 'همه محصولات')

@section('content')
    <style>
        .product-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .product-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            display: flex;
            flex-direction: column;
            transition: 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }

        .product-image-wrapper {
            background-color: #f5f5f5;
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image {
            max-height: 180px;
            width: auto;
            max-width: 90%;
            object-fit: contain;
        }

        .product-info {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #222;
        }

        .product-category {
            font-size: 13px;
            color: #888;
            margin-bottom: 10px;
        }

        .product-description {
            font-size: 14px;
            color: #555;
            margin-bottom: 12px;
            min-height: 45px;
            line-height: 1.6;
        }

        .product-price {
            font-size: 15px;
            margin-bottom: 8px;
            color: #28a745;
        }

        .original-price {
            text-decoration: line-through;
            color: #999;
            margin-left: 8px;
        }

        .discount-badge {
            background: #dc3545;
            color: #fff;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 8px;
        }

        .buttons {
            margin-top: auto;
            display: flex;
            gap: 8px;
        }

        .view-btn, .cart-btn {
            flex: 1;
            padding: 10px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .view-btn {
            background-color: #007bff;
            color: #fff;
        }

        .view-btn:hover {
            background-color: #0056b3;
        }

        .cart-btn {
            background-color: #ffc107;
            color: #222;
        }

        .cart-btn:hover {
            background-color: #e0a800;
        }

        .no-products {
            text-align: center;
            font-size: 18px;
            color: #666;
            margin-top: 60px;
        }
    </style>

    <div class="product-container">
        <h1 class="text-center mb-4">همه محصولات</h1>

        {{-- پیام موفقیت --}}
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 10px 16px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                {{ session('success') }}
            </div>
        @endif

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

                        <div class="product-info">
                            <h3 class="product-name">{{ $product->name }}</h3>

                            @if($product->category)
                                <div class="product-category">{{ $product->category->name }}</div>
                            @endif

                            <div class="product-description">{{ Str::limit($product->description, 70) }}</div>

                            @if($product->discount)
                                <div class="discount-badge">تخفیف {{ $product->discount }}٪</div>
                                <div class="product-price">
                                    <span class="original-price">{{ number_format($product->price) }} تومان</span>
                                    {{ number_format($product->price * (1 - $product->discount / 100)) }} تومان
                                </div>
                            @else
                                <div class="product-price">{{ number_format($product->price) }} تومان</div>
                            @endif

                            <div class="buttons">
                                <a href="{{ route('products.show', $product->id) }}" class="view-btn">مشاهده</a>
                                <form action="{{ route('cart.store') }}" method="POST" style="flex: 1;">
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
    </div>
@endsection
