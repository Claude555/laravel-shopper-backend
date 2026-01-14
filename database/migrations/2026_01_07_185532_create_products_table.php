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
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        $table->decimal('wholesale_price', 10, 2); // What you pay the wholesaler
        $table->decimal('selling_price', 10, 2);   // What the customer sees
        $table->integer('stock_status')->default(1); // 1 = Available, 0 = Out of Stock
        $table->string('category');
        $table->string('image')->nullable();
        $table->string('wholesaler_location')->nullable(); // e.g., "Kamukunji"
        $table->timestamps();
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
