@extends('layouts.app')

@section('title', 'محصولات')

@section('content')
    <style>
        .product-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .product-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .product-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
        }

        .product-image {
            width: 100%;
            display: block;
            object-fit: unset; /* ابعاد اصلی عکس حفظ شود */
        }

        .product-content {
            padding: 12px 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
        }

        .product-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #222;
        }

        .product-price {
            font-size: 15px;
            color: #28a745;
            margin-bottom: 6px;
        }

        .original-price {
            text-decoration: line-through;
            color: #999;
            margin-right: 6px;
        }

        .discount {
            font-size: 13px;
            color: #e3342f;
            margin-bottom: 8px;
        }

        .product-description {
            font-size: 13px;
            color: #555;
            margin-bottom: 10px;
        }

        .buttons {
            display: flex;
            gap: 8px;
            margin-top: auto;
        }

        .view-btn,
        .cart-btn {
            flex: 1;
            padding: 8px;
            font-size: 13px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s;
        }

        .view-btn {
            background: #007bff;
            color: white;
        }

        .view-btn:hover {
            background: #0056b3;
        }

        .cart-btn {
            background: #17a2b8;
            color: white;
        }

        .cart-btn:hover {
            background: #117a8b;
        }

        .no-products {
            text-align: center;
            font-size: 18px;
            color: #666;
            margin-top: 60px;
        }

        @media (max-width: 992px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="product-container">
        <h1 class="product-title">محصولات</h1>

        @if($products->isEmpty())
            <p class="no-products">محصولی یافت نشد.</p>
        @else
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <img 
                            src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}" 
                            alt="{{ $product->name }}" 
                            class="product-image"
                        >

                        <div class="product-content">
                            <h3 class="product-name">{{ $product->name }}</h3>

                            @if($product->discount)
                                <p class="product-price">
                                    <span class="original-price">{{ number_format($product->price, 0) }} تومان</span>
                                    {{ number_format($product->price * (1 - $product->discount / 100), 0) }} تومان
                                </p>
                                <p class="discount">تخفیف {{ $product->discount }}٪</p>
                            @else
                                <p class="product-price">{{ number_format($product->price, 0) }} تومان</p>
                            @endif

                            <p class="product-description">{{ Str::limit($product->description, 60) }}</p>

                            <div class="buttons">
                                <a href="{{ route('products.show', $product->id) }}" class="view-btn">مشاهده</a>

                                <form action="{{ route('cart.add', $product->id) }}" method="POST" style="flex: 1;">
                                    @csrf
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
