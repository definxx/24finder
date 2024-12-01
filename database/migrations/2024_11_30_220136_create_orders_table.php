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
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key for the user placing the order
            $table->unsignedBigInteger('item_id'); // Foreign key for the item being ordered
            $table->unsignedBigInteger('qty'); // Foreign key for the item being ordered
            $table->unsignedBigInteger('status'); // Foreign key for the item being ordered
            $table->decimal('offer', 10, 2)->nullable(); // Offer amount, optional
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
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
