<?php

   namespace App\View\Components;

   use Illuminate\View\Component;

   class ProductCard extends Component
   {
       public $name;
       public $price;
       public $discount;
       public $image;
       public $isNew;

       public function __construct($name, $price, $discount = null, $image = null, $isNew = false)
       {
           $this->name = $name;
           $this->price = $price;
           $this->discount = $discount;
           $this->image = $image;
           $this->isNew = $isNew;
       }

       public function render()
       {
           return view('components.product-card');
       }
   }