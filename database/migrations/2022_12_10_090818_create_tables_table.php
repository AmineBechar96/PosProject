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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->smallInteger('status')->nullable();
            $table->string('time',25)->nullable();
            $table->string('checked',50)->nullable();
            $table->unsignedBigInteger('zone_id'); 
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
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
        Schema::dropIfExists('tables');
    }
};
