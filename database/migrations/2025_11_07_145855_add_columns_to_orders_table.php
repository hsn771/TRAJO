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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->nullable()->after('id');
            $table->unsignedBigInteger('coupon_id')->nullable()->after('customer_id');
            $table->decimal('total_price', 10, 2)->after('coupon_id');
            $table->decimal('final_price', 10, 2)->after('total_price');
            $table->unsignedBigInteger('district_id')->nullable()->after('final_price');
            $table->unsignedBigInteger('division_id')->nullable()->after('district_id');
            $table->text('notes')->nullable()->after('division_id');
            $table->string('address')->nullable()->after('notes');
             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
            'customer_id',
            'coupon_id',
            'total_price',
            'final_price',
            'district_id',
            'division_id',
            'notes',
            'address'
        ]);
        });
    }
};

