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
        Schema::create('orders', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->float('total_price');
            $table->string('address');
            $table->string('pincode');
            $table->string('number');
            $table->string('status')->nullable();
            $table->timestamps();
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
