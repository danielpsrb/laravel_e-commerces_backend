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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->ulid('seller_id');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            //name product
            $table->string('name');
            //description product
            $table->text('description');
            //price product
            $table->decimal('price', 15, 2);
            //stock product
            $table->integer('stock');
            //image nullable
            $table->string('image')->nullable();
             //is_active
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            //foreign key seller id on users table
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
