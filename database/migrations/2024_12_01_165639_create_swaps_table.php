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
        Schema::create('swaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->onDelete('cascade'); // Link to the item being swapped
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User applying for the swap
            $table->string('status')->default('pending');
            $table->string('title');
            $table->text('description');
            $table->string('images')->nullable(); // Store image paths
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swaps');
    }
};
