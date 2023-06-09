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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->longText('profile_image')->nullable();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->bigInteger('phone')->unique();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->longText('address_1');
            $table->longText('address_2');
            $table->string('zipcode');
            $table->string('password');
            $table->enum('status', array('0', '1'))->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};