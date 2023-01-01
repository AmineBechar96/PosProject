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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username',45);
            $table->string('firstname',100);
            $table->string('lastname',100);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role',20);
            $table->string('last_active',50);
            $table->string('avatar',200);
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('store_id')->nullable();           
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
        Schema::dropIfExists('users');
    }
};
