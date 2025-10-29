<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id(); // INT PRIMARY KEY AUTO_INCREMENT

            $table->unsignedBigInteger('user_id');    // who saved the product
            $table->unsignedBigInteger('product_id'); // saved product
            $table->timestamps();

            // Foreign keys
            // $table->foreign('user_id')
            //       ->references('id')
            //       ->on('users')
            //       ->onDelete('cascade');

            // $table->foreign('product_id')
            //       ->references('id')
            //       ->on('products')
            //       ->onDelete('cascade');

            // Prevent duplicate product per user in wishlist
            $table->unique(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
