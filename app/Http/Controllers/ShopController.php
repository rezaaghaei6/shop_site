<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

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
        return view('products', compact('products'));
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
        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price * (1 - ($product->discount ?? 0) / 100),
            'quantity' => 1,
            'attributes' => [
                'image' => $product->image,
            ],
        ]);
        return redirect()->back()->with('message', 'محصول به سبد خرید اضافه شد!');
    }
}