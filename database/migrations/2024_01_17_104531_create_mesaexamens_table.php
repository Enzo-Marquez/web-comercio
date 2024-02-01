<?php

// database/migrations/xxxx_xx_xx_create_mesas_examenes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesaexamensTable extends Migration
{
    public function up()
    {
        Schema::create('mesaexamens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carreras_id');
            $table->unsignedBigInteger('anios_id');
            $table->unsignedBigInteger('unidad_curriculars_id');
            $table->unsignedBigInteger('turnos_id');
            $table->unsignedBigInteger('user_id');

            $table->foreignId('presidente_id')
                ->nullable()
                ->constrained('docentes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            
            $table->foreignId('vocal_id')
                ->nullable()
                ->constrained('docentes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('vocal2_id')
                ->nullable()
                ->constrained('docentes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            // Otras columnas necesarias para tu mesa de examen
            $table->time('hora');
            $table->date('llamado');
            $table->date('llamado2');
            $table->timestamps();

            $table->foreign('carreras_id')->references('id')->on('carreras')->onDelete('cascade');
            $table->foreign('anios_id')->references('id')->on('anios')->onDelete('cascade');
            $table->foreign('unidad_curriculars_id')->references('id')->on('unidad_curriculars')->onDelete('cascade');
            $table->foreign('turnos_id')->references('id')->on('turnos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mesaexamens');
    }
}

