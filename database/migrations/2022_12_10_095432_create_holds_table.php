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
        Schema::create('holds', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('time',40);
            $table->unsignedBigInteger('register_id')->nullable(); 
            $table->foreign('register_id')->references('id')->on('registers')->onDelete('cascade');
            $table->unsignedBigInteger('table_id')->nullable(); 
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
            $table->unsignedBigInteger('waiter_id')->nullable(); 
            $table->foreign('waiter_id')->references('id')->on('waiters')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id')->nullable(); 
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holds');
    }
};
