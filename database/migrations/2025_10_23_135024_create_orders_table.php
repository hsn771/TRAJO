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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();$table->unsignedBigInteger('user_id');
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->string('status', 50)->default('pending');      // order status
            $table->timestamp('created_at')->useCurrent();         // order created
            $table->timestamp('updated_at')->nullable();           // updated timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
