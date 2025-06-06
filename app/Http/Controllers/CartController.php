<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // فقط کاربرهای لاگین شده اجازه کار با سبد خرید دارن
    public function __construct()
    {
        $this->middleware('auth');
    }

    // نمایش سبد خرید
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            $cartItems = collect();
        } else {
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get();

            $cartItems = $products->map(function ($product) use ($cart) {
                return (object)[
                    'product' => $product,
                    'quantity' => $cart[$product->id]['quantity'],
                ];
            });
        }

        return view('cart', compact('cartItems'));
    }

    // افزودن محصول به سبد خرید
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->product_id;
        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'discount' => $product->discount ?? 0,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('message', 'محصول به سبد خرید اضافه شد.');
    }

    // حذف محصول از سبد خرید
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('message', 'محصول از سبد خرید حذف شد.');
    }

    // بروزرسانی تعداد محصول در سبد خرید
    public function update(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('message', 'تعداد محصول بروزرسانی شد.');
    }

    // ثبت سفارش (پاک کردن سبد خرید)
    public function checkout()
    {
        // اینجا می‌تونی کد ثبت سفارش در دیتابیس هم اضافه کنی
        session()->forget('cart');

        return redirect()->route('cart.index')->with('message', 'سفارش شما ثبت شد.');
    }
}
