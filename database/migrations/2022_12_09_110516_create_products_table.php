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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20);
            $table->string('name', 25);
            $table->float('cost');
            $table->string('tax', 11)->nullable();
            $table->mediumText('description')->nullable();
            $table->float('price');
            $table->string('photo', 200);
            $table->string('photothumb', 500)->nullable();
            $table->string('color', 20);
            $table->boolean('type')->nullable();
            $table->integer('alertqt')->nullable();
            $table->string('unit', 100)->nullable();
            $table->integer('taxmethod')->nullable();
            $table->string('h_stores', 300)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('category_id')->nullable();           
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('supplier_id')->nullable();           
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
