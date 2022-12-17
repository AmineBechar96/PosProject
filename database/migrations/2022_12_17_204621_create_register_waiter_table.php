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
        Schema::create('register_waiter', function (Blueprint $table) {
            $table->id();
            $table->double('cash_in_hand');
            $table->unsignedBigInteger('register_id')->nullable();           
            $table->foreign('register_id')->references('id')->on('registers')->onDelete('cascade');
            $table->unsignedBigInteger('waiter_id')->nullable();           
            $table->foreign('waiter_id')->references('id')->on('waiters')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_waiter');
    }
};
