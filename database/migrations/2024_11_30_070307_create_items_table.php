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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->text('description');
            $table->string('condition');
            $table->string('swap_preferences')->nullable(); // Optional field
            $table->decimal('price', 10, 2)->nullable(); // Optional price field
            $table->json('images'); // Store image paths as JSON
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who posted the item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
