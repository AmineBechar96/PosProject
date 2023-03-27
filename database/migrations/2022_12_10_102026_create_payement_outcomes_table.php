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
        Schema::create('payement_outcomes', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->double('paid')->nullable();
            $table->smallInteger('type')->nullable();
            $table->bigInteger('credit_card_number')->nullable();
            $table->string('credit_card_holder')->nullable();
            $table->unsignedBigInteger('created_by');           
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('register_id');           
            $table->foreign('register_id')->references('id')->on('registers')->onDelete('cascade');
            $table->unsignedBigInteger('purchase_id');           
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
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
        Schema::dropIfExists('payements');
    }
};
