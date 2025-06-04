<?php
   namespace App\Http\Controllers;

   use App\Models\Product;
   use Illuminate\Http\Request;

   class HomeController extends Controller
   {
       public function index()
       {
           $products = Product::with('category')->latest()->take(6)->get(); // 6 محصول آخر
           return view('home', compact('products'));
       }
   }