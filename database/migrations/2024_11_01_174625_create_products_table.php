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
            $table->integer('seller_id');
            $table->string('image');
            $table->string('name');
            $table->integer('price');
            $table->string('category');
            $table->longText('description');

            $table->string('weight');
            $table->string('country_of_origin');
            $table->string('quality');
            $table->string('check');
            $table->string('min_weight');
            $table->string('status')->default('deactive');
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
