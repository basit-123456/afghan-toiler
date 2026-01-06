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
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('order_item');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('clothes_price', 10, 2);
            $table->decimal('paid_amount', 10, 2);
            $table->enum('delivery_status', ['pending', 'delivered', 'paid_complete'])->default('pending');
            $table->date('finish_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_orders');
    }
};
