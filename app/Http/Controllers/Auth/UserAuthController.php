<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    // نمایش فرم ثبت‌نام
    public function showRegister()
    {
        return view('auth.user.register');
    }

    // ثبت‌نام کاربر
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('message', 'ثبت‌نام با موفقیت انجام شد.');
    }

    // نمایش فرم ورود
    public function showLogin()
    {
        return view('auth.user.login');
    }

    // ورود کاربر
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (auth()->user()->role === 'user') {
                return redirect()->route('home');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'شما مجاز به ورود نیستید.']);
            }
        }

        return redirect()->back()->withErrors(['email' => 'اطلاعات ورود نادرست است.']);
    }

    // خروج
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
