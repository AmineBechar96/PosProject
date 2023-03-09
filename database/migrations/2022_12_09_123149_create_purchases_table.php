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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('reference',20)->nullable();
            $table->date('date')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('discount')->nullable();
            $table->float('total')->nullable();
            $table->float('payement')->nullable();
            $table->text('description')->nullable();
            $table->text('attachment')->nullable();
            $table->mediumText('note')->nullable();
            $table->smallInteger('status')->nullable();
            $table->smallInteger('type')->nullable();
            $table->smallInteger('status')->default(0);
            
            $table->timestamps();
            $table->unsignedBigInteger('created_by');           
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('store_id');           
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->unsignedBigInteger('warehouse_id');           
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->unsignedBigInteger('supplier_id');           
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
        Schema::dropIfExists('sales');
    }
};
