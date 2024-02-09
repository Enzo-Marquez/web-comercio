<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('ainscriptions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('mesaexamen_id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('uinscriptions_id');
        // Otros campos según tus necesidades
        $table->timestamps();

        $table->foreign('mesaexamen_id')->references('id')->on('mesaexamens')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('uinscriptions_id')->references('id')->on('uinscriptions')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('ainscriptions');
}

};
