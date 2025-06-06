<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function home()
    {
        $products = Product::with('category')->latest()->take(6)->get();
        return view('home', compact('products'));
    }

    public function products()
    {
        $products = Product::with('category')->latest()->get();
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function categories()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function addToCart(Product $product)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id, // ← افزودن product_id
                'name' => $product->name,
                'price' => $product->price * (1 - ($product->discount ?? 0) / 100),
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('message', 'محصول به سبد خرید اضافه شد!');
    }

    public function cart()
    {
        $cart = session()->get('cart', []);

        $cartItems = collect($cart)->map(function ($item, $productId) {
            $product = Product::find($productId);
            if ($product) {
                return (object) [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                ];
            }
            return null;
        })->filter();

        return view('cart', compact('cartItems'));
    }

    public function updateCart(Request $request, $id)
    {
        $quantity = $request->input('quantity', 1);
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity > 0 ? $quantity : 1;
            Session::put('cart', $cart);
        }
        return redirect()->route('cart')->with('message', 'سبد خرید به‌روزرسانی شد!');
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        return redirect()->route('cart')->with('message', 'محصول از سبد خرید حذف شد!');
    }

    public function checkout()
    {
        Session::forget('cart');
        return redirect()->route('home')->with('message', 'سفارش شما با موفقیت ثبت شد!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%$query%")
                          ->orWhere('description', 'like', "%$query%")
                          ->with('category')
                          ->get();
        return view('products.index', compact('products'));
    }
}
