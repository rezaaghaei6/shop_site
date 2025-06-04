<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه ایران | @yield('title')</title>
    <link href="https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Vazirmatn', Arial, sans-serif;
            background-color: #f4f4f9;
            direction: rtl;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* هدر */
        header {
            background: linear-gradient(to right, #1e3a8a, #3b82f6);
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }

        header .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        header .logo img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 3px solid #ffffff;
            transition: transform 0.3s ease;
        }

        header .logo img:hover {
            transform: rotate(360deg);
        }

        header .logo h1 {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        header nav {
            display: flex;
            gap: 25px;
        }

        header nav a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease;
        }

        header nav a::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 0;
            height: 2px;
            background: #ffffff;
            transition: width 0.3s ease;
        }

        header nav a:hover::after {
            width: 100%;
        }

        header nav a:hover {
            color: #bfdbfe;
        }

        header .mobile-menu-button {
            display: none;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }

        header .mobile-menu {
            display: none;
            background: #1e40af;
            padding: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            width: 100%;
        }

        header .mobile-menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        header .mobile-menu a:hover {
            color: #bfdbfe;
        }

        /* فوتر */
        footer {
            background: #111827;
            color: white;
            padding: 50px 20px 20px;
        }

        footer .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
        }

        footer h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ffffff;
        }

        footer p, footer a {
            color: #9ca3af;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        footer a {
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #3b82f6;
        }

        footer .social-icons {
            display: flex;
            gap: 15px;
        }

        footer .social-icons svg {
            width: 28px;
            height: 28px;
            transition: transform 0.3s ease;
        }

        footer .social-icons a:hover svg {
            transform: scale(1.2);
        }

        footer .footer-bottom {
            border-top: 1px solid #374151;
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
            font-size: 0.85rem;
            color: #9ca3af;
        }

        /* صفحه خانه */
        .home-page {
            background: linear-gradient(to right, #1e3a8a, #3b82f6);
            color: white;
            padding: 50px 20px;
            text-align: center;
            border-radius: 12px;
            margin-bottom: 40px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .home-page h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .home-page p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .home-page a {
            display: inline-block;
            background: #ffffff;
            color: #1e3a8a;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .home-page a:hover {
            background: #bfdbfe;
            transform: scale(1.05);
        }

        /* صفحه محصولات */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .product-card .image-placeholder {
            height: 200px;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            font-size: 1rem;
            font-weight: 500;
        }

        .product-card .content {
            padding: 20px;
        }

        .product-card h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .product-card p {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .product-card .description {
            color: #9ca3af;
            font-size: 0.85rem;
            line-height: 1.4em;
            max-height: 2.8em; /* 2 خط */
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        .product-card .buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .product-card a {
            flex: 1;
            text-align: center;
            padding: 10px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .product-card .view-btn {
            background: #1e3a8a;
            color: white;
        }

        .product-card .view-btn:hover {
            background: #1e40af;
            transform: scale(1.03);
        }

        .product-card .cart-btn {
            background: #e5e7eb;
            color: #1f2937;
        }

        .product-card .cart-btn:hover {
            background: #d1d5db;
            transform: scale(1.03);
        }

        /* صفحه درباره ما */
        .about-page {
            padding: 50px 20px;
            text-align: center;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .about-page h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .about-page p {
            font-size: 1.1rem;
            color: #6b7280;
            max-width: 800px;
            margin: 0 auto 20px;
        }

        /* صفحه تماس با ما */
        .contact-page {
            padding: 50px 20px;
            text-align: center;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .contact-page h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .contact-page p {
            font-size: 1.1rem;
            color: #6b7280;
            max-width: 800px;
            margin: 0 auto 15px;
        }

        /* صفحه دسته‌بندی‌ها */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .category-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .category-card .image-placeholder {
            height: 150px;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            font-size: 1rem;
            font-weight: 500;
        }

        .category-card .content {
            padding: 20px;
        }

        .category-card h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .category-card p {
            color: #6b7280;
            font-size: 0.9rem;
            line-height: 1.4em;
            max-height: 2.8em; /* 2 خط */
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        .category-card a {
            display: inline-block;
            background: #1e3a8a;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            margin-top: 15px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .category-card a:hover {
            background: #1e40af;
            transform: scale(1.03);
        }

        /* استایل‌های اضافی */
        .categories-title, .products-title {
            font-size: 1.8rem;
            font-weight: 700;
            text-align: center;
            color: #1f2937;
            margin-bottom: 30px;
        }

        .no-categories, .no-products {
            text-align: center;
            color: #6b7280;
            font-size: 1.1rem;
            margin: 40px 0;
        }

        /* واکنش‌گرایی */
        @media (max-width: 768px) {
            header nav {
                display: none;
            }
            header .mobile-menu-button {
                display: block;
            }
            header .mobile-menu {
                display: none;
            }
            header .mobile-menu.active {
                display: block;
            }
            header .logo h1 {
                font-size: 1.4rem;
            }
            .home-page h1, .about-page h1, .contact-page h1 {
                font-size: 1.8rem;
            }
            .home-page p, .about-page p, .contact-page p {
                font-size: 1rem;
            }
            .products-grid, .categories-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
            footer .container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('layouts.header')
    <main>
        @yield('content')
    </main>
    @include('layouts.footer')
</body>
</html>