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
    Schema::create('orden_compra_detalles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('orden_compra_id')->constrained('orden_compras')->onDelete('cascade');
        $table->string('sector');
        $table->string('programa');
        $table->string('actividad');
        $table->string('partida');
        $table->string('generica');
        $table->string('especifica');
        $table->string('subespecifica');
        $table->decimal('monto', 15, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_compra_detalles');
    }
};
