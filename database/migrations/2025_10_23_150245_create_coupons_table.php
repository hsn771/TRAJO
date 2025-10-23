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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
             $table->integer('discount_type')->default(1)->comment('1=percentage, 2=fixed amount');
             $table->decimal('discount_value',10,2)->nullable();
             $table->integer('usage_limit')->nullable();
             $table->integer('used_count')->nullable();
             $table->decimal('min_order_amount',10,2)->nullable();
             $table->date('start_date')->nullable();
             $table->date('end_date')->nullable();
             $table->integer('is_active')->default(0)->comment('0=inactive, 1=active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
