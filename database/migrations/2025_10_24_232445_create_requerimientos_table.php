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
    Schema::create('requerimientos', function (Blueprint $table) {
        $table->id();
        $table->string('numero_requerimiento');
        $table->string('oficina');
        $table->date('fecha');
        $table->string('elaborado_por_nombre');
        $table->string('elaborado_por_cargo');
        $table->string('recibido_por_nombre');
        $table->string('recibido_por_cargo');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requerimientos');
    }
};
