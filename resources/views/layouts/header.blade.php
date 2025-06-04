<header>
    <div class="container">
        <div class="logo">
            <img src="https://via.placeholder.com/50" alt="لوگو">
            <h1>فروشگاه ایران</h1>
        </div>
        <nav>
            <a href="{{ route('home') }}">خانه</a>
            <a href="{{ route('products') }}">محصولات</a>
            <a href="{{ route('categories') }}">دسته‌بندی‌ها</a>
            <a href="{{ route('about') }}">درباره ما</a>
            <a href="{{ route('contact') }}">تماس با ما</a>
        </nav>
        <button class="mobile-menu-button">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="mobile-menu">
            <a href="{{ route('home') }}">خانه</a>
            <a href="{{ route('products') }}">محصولات</a>
            <a href="{{ route('categories') }}">دسته‌بندی‌ها</a>
            <a href="{{ route('about') }}">درباره ما</a>
            <a href="{{ route('contact') }}">تماس با ما</a>
        </div>
    </div>
</header>

<script>
    document.querySelector('.mobile-menu-button').addEventListener('click', () => {
        document.querySelector('.mobile-menu').classList.toggle('active');
    });
</script>