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
            $table->ulid('id')->primary();
            //user_id
            $table->ulid('user_id');
            //address_id
            $table->foreignId('address_id')->constrained('addresses')->onDelete('cascade');
            //seller_id
            $table->ulid('seller_id');
            //total_price
            $table->decimal('total_price', 15, 2);
            //shipping_price
            $table->decimal('shipping_price', 15, 2);
            //grand_total
            $table->decimal('grand_total', 15, 2);
            //status string
            $table->string('status')->default('PENDING');
            //payment_method nullable
            $table->string('payment_method')->nullable();
            //payment_va_name nullable
            $table->string('payment_va_name')->nullable();
            //payment_va_number nullable
            $table->string('payment_va_number')->nullable();
            //payment_va_wallet_name nullable
            $table->string('payment_wallet_name')->nullable();
            //payment_va_wallet_number nullable
            $table->string('payment_wallet_number')->nullable();
            //shipping_service
            $table->string('shipping_service')->nullable();
            //shipping_receipt
            $table->string('shipping_number')->nullable();
            //transaction_number
            $table->string('transaction_number')->nullable();
            $table->timestamps();

            //foreign key user id on users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            //foreign key seller id on users table
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
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
