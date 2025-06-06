<header dir="rtl">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600&display=swap');

        header {
            font-family: 'Vazirmatn', sans-serif;
            background: #f0f4ff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            width: 44px;
            height: 44px;
            border-radius: 6px;
        }

        .logo h1 {
            font-size: 20px;
            font-weight: 700;
            color: #1e2a3a;
            margin: 0;
        }

        nav.nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        nav.nav-links a,
        nav.nav-links form button {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            padding: 0;
        }

        nav.nav-links a:hover,
        nav.nav-links form button:hover {
            color: #007bff;
            text-decoration: underline;
        }

        .cart-link {
            position: relative;
        }

        .cart-count {
            background-color: crimson;
            color: white;
            border-radius: 999px;
            font-size: 12px;
            padding: 2px 6px;
            position: absolute;
            top: -6px;
            right: -12px;
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-form input[type="text"] {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .search-form button {
            background: #007bff;
            border: none;
            color: white;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
        }

        .mobile-nav {
            display: none;
            flex-direction: column;
            background-color: #f8faff;
            padding: 1rem;
            border-top: 1px solid #ddd;
        }

        .mobile-nav.active {
            display: flex;
        }

        .mobile-nav a,
        .mobile-nav form button {
            padding: 8px 0;
            text-decoration: none;
            color: #333;
            background: none;
            border: none;
            font-weight: 500;
            cursor: pointer;
            font-size: 16px;
        }

        .mobile-nav a:hover,
        .mobile-nav form button:hover {
            color: #007bff;
            text-decoration: underline;
        }

        .mobile-search {
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            nav.nav-links,
            .search-form {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }
        }
    </style>

    <div class="header-container">
        {{-- لوگو --}}
        <div class="logo">
            <img src="https://via.placeholder.com/50" alt="لوگو">
            <h1>فروشگاه ایران</h1>
        </div>

        {{-- منوی دسکتاپ --}}
        <nav class="nav-links">
            <a href="{{ route('home') }}">خانه</a>
            <a href="{{ route('products') }}">محصولات</a>
            <a href="{{ route('categories') }}">دسته‌ها</a>
            <a href="{{ route('about') }}">درباره ما</a>
            <a href="{{ route('contact') }}">تماس با ما</a>

            @auth
                <a href="{{ route('cart.index') }}" class="cart-link">
                    سبد خرید
                    <span class="cart-count">{{ count(Session::get('cart', [])) }}</span>
                </a>
                <span style="font-weight: 600; color: #333;">{{ Auth::user()->name }}</span>
                <form action="{{ route('user.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" title="خروج">خروج</button>
                </form>
            @else
                <a href="{{ route('user.login.form') }}">ورود</a>
                <a href="{{ route('user.register.form') }}">ثبت‌نام</a>
            @endauth
        </nav>

        {{-- جستجو دسکتاپ --}}
        <form action="{{ route('products.search') }}" method="GET" class="search-form">
            <input type="text" name="query" placeholder="جستجوی محصول...">
            <button type="submit">جستجو</button>
        </form>

        {{-- دکمه موبایل --}}
        <button class="mobile-menu-btn" onclick="document.querySelector('.mobile-nav').classList.toggle('active')">
            ☰
        </button>
    </div>

    {{-- منوی موبایل --}}
    <div class="mobile-nav">
        <a href="{{ route('home') }}">خانه</a>
        <a href="{{ route('products') }}">محصولات</a>
        <a href="{{ route('categories') }}">دسته‌ها</a>
        <a href="{{ route('about') }}">درباره ما</a>
        <a href="{{ route('contact') }}">تماس با ما</a>

        @auth
            <a href="{{ route('cart.index') }}">سبد خرید ({{ count(Session::get('cart', [])) }})</a>
            <span style="font-weight: 600; color: #333; padding: 8px 0;">{{ Auth::user()->name }}</span>
            <form action="{{ route('user.logout') }}" method="POST" style="padding: 8px 0;">
                @csrf
                <button type="submit" title="خروج">خروج</button>
            </form>
        @else
            <a href="{{ route('user.login.form') }}">ورود</a>
            <a href="{{ route('user.register.form') }}">ثبت‌نام</a>
        @endauth

        {{-- جستجوی موبایل --}}
        <form action="{{ route('products.search') }}" method="GET" class="search-form mobile-search">
            <input type="text" name="query" placeholder="جستجو...">
            <button type="submit">جستجو</button>
        </form>
    </div>
</header>
