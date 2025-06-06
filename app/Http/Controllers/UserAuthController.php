<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // یا هر view دیگه‌ای که داری
    }

    public function login(Request $request)
    {
        // لاگیک ورود
    }

    public function showRegisterForm()
    {
        return view('auth.register'); // یا view مربوط به ثبت‌نام
    }

    public function register(Request $request)
    {
        // لاگیک ثبت‌نام
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
