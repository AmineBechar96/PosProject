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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('tax')->nullable();
            $table->integer('discount')->nullable();
            $table->float('sub_total')->nullable();
            $table->float('total')->nullable();
            $table->integer('total_items')->nullable();
            $table->float('paid')->nullable();
            $table->smallInteger('type')->nullable();
            $table->bigInteger('credit_card_number')->nullable();
            $table->string('credit_card_holder')->nullable();
            $table->float('tax_amount')->nullable();
            $table->float('discount_amount')->nullable();
            $table->float('first_payement')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by');           
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('client_id');           
            $table->foreign('client_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('register_id');           
            $table->foreign('register_id')->references('id')->on('registers')->onDelete('cascade');
            $table->unsignedBigInteger('waiter_id');           
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
        Schema::dropIfExists('sales');
    }
};
