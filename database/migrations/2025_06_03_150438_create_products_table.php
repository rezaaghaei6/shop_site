<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // نام محصول
            $table->text('description')->nullable(); // توضیحات
            $table->decimal('price', 8, 2); // قیمت (مثل 1000.00)
            $table->integer('stock'); // موجودی
            $table->string('image')->nullable(); // تصویر محصول
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
