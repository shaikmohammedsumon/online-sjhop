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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('byUser_Id');
            $table->string('addToCart_ID');
            $table->string('byUserFirstName');
            $table->string('byUserLastName');
            $table->string('companyName')->default('none');
            $table->string('address');
            $table->string('town_city');
            $table->string('country')->default('Bangladesh');
            $table->string('postConde');
            $table->string('phone');
            $table->string('email');
            $table->string('description');
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
