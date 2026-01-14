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
        Schema::create('customer_requests', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->string('customer_name');
        $table->string('phone_number');
        $table->text('item_description');
        $table->string('location');
        $table->string('status')->default('Pending');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_requests');
    }
};
