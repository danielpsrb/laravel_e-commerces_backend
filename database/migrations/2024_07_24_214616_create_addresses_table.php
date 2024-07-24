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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->ulid('user_id');
            //country
            $table->string('country');
            //province
            $table->string('province');
            //city
            $table->string('city');
            //district
            $table->string('district');
            //postal code
            $table->string('postal_code');
            //detail address
            $table->text('address');
            $table->timestamps();

            //foreign key user id on users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
