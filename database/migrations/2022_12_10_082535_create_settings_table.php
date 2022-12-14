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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 100);
            $table->string('logo', 200)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('currency', 10)->nullable();
            $table->boolean('keyboard');
            $table->text('receiptheader')->nullable();
            $table->text('receiptfooter');
            $table->string('theme', 20);
            $table->integer('tax')->nullable();
            $table->integer('discount')->nullable();
            $table->string('timezone', 400)->nullable();
            $table->string('language', 30)->nullable();
            $table->smallInteger('stripe')->nullable();
            $table->string('stripe_secret_key', 150)->nullable();
            $table->string('stripe_publishable_key', 150)->nullable();
            $table->integer('decimals')->nullable();
            $table->string('time_visit', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
