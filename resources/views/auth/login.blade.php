<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
    <style>
        @font-face {
            font-family: 'Vazir';
            src: url('https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.woff2') format('woff2');
        }

        * {
            box-sizing: border-box;
            font-family: 'Vazir', sans-serif;
            direction: rtl;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f1f5f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #007bff;
            padding: 16px 32px;
            color: white;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        footer {
            background-color: #f8f9fa;
            padding: 16px 32px;
            text-align: center;
            color: #555;
            font-size: 0.9rem;
            margin-top: auto;
            box-shadow: 0 -1px 4px rgba(0,0,0,0.05);
        }

        .login-container {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 440px;
            margin: 40px auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #0056b3;
        }

        .link {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: #007bff;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        .alert {
            background-color: #f8d7da;
            color: #842029;
            padding: 10px 16px;
            margin-bottom: 16px;
            border-radius: 6px;
            border: 1px solid #f5c2c7;
        }

        .invalid-feedback {
            color: red;
            font-size: 0.875em;
            margin-top: 4px;
        }
    </style>
</head>
<body>

<header>
    فروشگاه اینترنتی من
</header>

<main class="login-container">
    <h2>ورود کاربر</h2>

    @if(session('error'))
        <div class="alert">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('user.login') }}">
        @csrf

        <div class="form-group">
            <label for="phone">شماره تلفن</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">رمز عبور</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn">ورود</button>

        <a href="{{ route('user.register.form') }}" class="link">حساب ندارید؟ ثبت‌نام کنید</a>
    </form>
</main>

<footer>
    © {{ date('Y') }} تمامی حقوق محفوظ است | طراحی شده توسط تیم شما
</footer>

</body>
</html>
