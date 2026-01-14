<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->text('image')->change(); // Text can hold long JSON strings
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('text_on_products', function (Blueprint $table) {
            //
        });
    }
};
