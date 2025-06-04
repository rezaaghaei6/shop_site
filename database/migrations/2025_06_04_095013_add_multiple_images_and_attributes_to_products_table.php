<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleImagesAndAttributesToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->json('images')->nullable()->after('image');
            $table->decimal('discount', 5, 2)->nullable()->after('price');
            $table->json('attributes')->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['images', 'discount', 'attributes']);
        });
    }
}