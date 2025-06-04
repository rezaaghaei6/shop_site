@extends('layouts.app')

@section('title', 'تماس با ما')

@section('content')
    <div class="container">
        <div class="contact-page">
            <h1>تماس با ما</h1>
            <p>برای ارتباط با ما از اطلاعات زیر استفاده کنید یا فرم زیر رو پر کنید:</p>
            <p>ایمیل: info@iranstore.com</p>
            <p>تلفن: ۰۲۱-۱۲۳۴۵۶۷۸</p>
            <p>آدرس: تهران، خیابان آزادی، پلاک ۱۲۳</p>
            <form action="#" method="POST" style="max-width: 600px; margin: 20px auto;">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label for="name" style="display: block; font-weight: 600; color: #1f2937;">نام:</label>
                    <input type="text" id="name" name="name" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="email" style="display: block; font-weight: 600; color: #1f2937;">ایمیل:</label>
                    <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="message" style="display: block; font-weight: 600; color: #1f2937;">پیام:</label>
                    <textarea id="message" name="message" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; min-height: 100px;"></textarea>
                </div>
                <button type="submit" style="background: #1e3a8a; color: white; padding: 12px 30px; border: none; border-radius: 25px; font-weight: 600; cursor: pointer; transition: background 0.3s ease;">
                    ارسال پیام
                </button>
            </form>
        </div>
    </div>
@endsection