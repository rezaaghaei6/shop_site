<div class="product-card">
       <div class="product-image-wrapper">
           <img src="{{ $image ? asset('storage/' . $image) : asset('images/placeholder.jpg') }}" alt="{{ $name }}" class="product-image">
           @if($discount)
               <span class="product-tag sale">SALE!!</span>
           @elseif($isNew)
               <span class="product-tag new">NEW</span>
           @endif
       </div>
       <div class="product-content">
           <h3 class="product-title">{{ $name }}</h3>
           <p class="product-price">
               @if($discount)
                   <span class="original-price">{{ number_format($price, 2) }} تومان</span>
                   <span class="discounted-price">{{ number_format($price * (1 - $discount / 100), 2) }} تومان</span>
               @else
                   <span class="discounted-price">{{ number_format($price, 2) }} تومان</span>
               @endif
           </p>
       </div>
   </div>