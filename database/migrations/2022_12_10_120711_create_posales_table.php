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
        Schema::create('posales', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->nullable();
            $table->float('price');
            $table->smallInteger('status');
            $table->integer('number');
            $table->string('time', 50);
            $table->string('time_visit', 50);
            $table->unsignedBigInteger('table_id')->nullable();           
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
            $table->unsignedBigInteger('register_id')->nullable();           
            $table->foreign('register_id')->references('id')->on('registers')->onDelete('cascade');
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
        Schema::dropIfExists('posales');
    }
};
