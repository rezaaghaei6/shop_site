@extends('layouts.app')

@section('title', 'دسته‌بندی‌ها')

@section('content')
    <style>
        .categories-title {
            font-size: 28px;
            margin-bottom: 24px;
            text-align: center;
            font-weight: bold;
            color: #333;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .category-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 16px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: box-shadow 0.3s ease;
        }

        .category-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .image-placeholder {
            width: 100%;
            height: 140px;
            background-color: #e9ecef;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #888;
            font-size: 16px;
            margin-bottom: 16px;
            user-select: none;
        }

        .category-card h3 {
            margin-bottom: 8px;
            font-size: 20px;
            color: #222;
        }

        .category-card p {
            color: #555;
            font-size: 14px;
            margin-bottom: 16px;
            min-height: 40px;
        }

        .category-card a {
            text-decoration: none;
            color: #007bff;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .category-card a:hover {
            color: #0056b3;
        }

        .no-categories {
            text-align: center;
            font-size: 16px;
            color: #777;
            margin-top: 40px;
        }

        @media (max-width: 992px) {
            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .categories-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="container">
        <h2 class="categories-title">دسته‌بندی‌های محصولات</h2>
        <div class="categories-grid">
            @forelse($categories as $category)
                <div class="category-card">
                    <div class="image-placeholder">تصویر دسته‌بندی (به‌زودی)</div>
                    <div class="content">
                        <h3>{{ $category->name }}</h3>
                        <p>{{ $category->description ?? 'بدون توضیحات' }}</p>
                        <a href="#">مشاهده محصولات</a>
                    </div>
                </div>
            @empty
                <p class="no-categories">دسته‌بندی‌ای یافت نشد. لطفاً از پنل مدیریت دسته‌بندی اضافه کنید.</p>
            @endforelse
        </div>
    </div>
@endsection
