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
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->after('id');
            $table->unsignedBigInteger('product_id')->after('order_id');
            $table->integer('quantity')->default(1)->after('product_id');
            $table->decimal('price', 10, 2)->after('quantity');
            $table->decimal('line_total', 10, 2)->after('price');

            // ✅ Optional: Add foreign keys (uncomment if relationships exist)
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Drop columns in reverse order
            $table->dropColumn([
                'order_id',
                'product_id',
                'quantity',
                'price',
                'line_total'
            ]);
        });
    }
};
