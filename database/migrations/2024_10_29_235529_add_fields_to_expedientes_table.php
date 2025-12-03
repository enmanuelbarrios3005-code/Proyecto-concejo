<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('expedientes')) {
            Schema::create('expedientes', function (Blueprint $table) {
                $table->id();
                $table->string('cedula');
                $table->string('telefono');
                $table->unsignedBigInteger('user_id');
                $table->string('numero_cuenta');
                $table->date('fecha_ingreso');
                $table->string('imagen')->nullable();
                $table->string('archivo')->nullable();
                $table->string('estado')->nullable();
                $table->string('cargo')->nullable(); // Asegúrate de que esta línea esté en la migración 
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
        if (!Schema::hasTable('documentos')) {
            Schema::create('documentos', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');
                $table->string('ruta');
                $table->unsignedBigInteger('expediente_id'); // Clave foránea
                $table->timestamps();
                $table->foreign('expediente_id')->references('id')->on('expedientes')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
        Schema::dropIfExists('expedientes');
    }
};