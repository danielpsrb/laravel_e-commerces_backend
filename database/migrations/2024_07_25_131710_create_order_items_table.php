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
        Schema::create('order_items', function (Blueprint $table) {
            $table->ulid('id')->primary();
            //order_id
            $table->ulid('order_id');
            //product_id
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            //quantity
            $table->integer('quantity');
            //price
            $table->decimal('price', 15, 2);
            $table->timestamps();

            //foreign key order id on orders table
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
