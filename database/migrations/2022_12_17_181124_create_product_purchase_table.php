<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_purchase', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->float('price');
            $table->date('date');
            $table->unsignedBigInteger('purchase_id')->nullable();           
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();           
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_purchase');
    }
};
