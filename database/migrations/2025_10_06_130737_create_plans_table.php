<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // Plan name e.g., Basic, Premium
            $table->string('description')->nullable();
            $table->string('stripe_product_id');    // Stripe Product ID
            $table->string('stripe_price_id');      // Stripe Price ID
            $table->decimal('price', 10, 2);        // Price in your currency
            $table->string('currency', 10)->default('INR');
            $table->string('billing_interval')->default('month'); // month, year
            $table->integer('streams')->default(1);
            $table->integer('downloads')->default(1);
            $table->string('quality')->nullable();
            $table->string('resolution')->nullable();
            $table->string('devices')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
