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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->boolean('status');
            $table->float('cash_total')->nullable();
            $table->float('cash_sub')->nullable();
            $table->float('cash_inhand')->nullable();
            $table->float('cc_total')->nullable();
            $table->float('cc_sub')->nullable();
            $table->float('cheque_total')->nullable();
            $table->float('cheque_sub')->nullable();
            $table->text('note')->nullable();
            $table->text('waiterscih')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');           
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('closed_by');           
            $table->foreign('closed_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('store_id');           
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registers');
    }
};
