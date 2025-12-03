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
    Schema::create('orden_compras', function (Blueprint $table) {
        $table->id();
        
        // --- Relación ---
        $table->foreignId('requerimiento_id')->nullable()->constrained('requerimientos');

        // --- Encabezado ---
        $table->string('numero_orden'); // "Nº 000119"
        $table->date('fecha_orden'); // "8/8/2025"
        $table->string('rif')->nullable(); // "G-20007405-1"
        $table->decimal('monto_bs', 15, 2); // "641,82" (el de arriba)
        $table->text('cantidad_letras'); // "Seiscientos cuarenta y uno..."

        // --- Info Media ---
        $table->string('orden_compra_numero')->nullable(); // El campo "ORDEN DE COMPRA N°"
        $table->string('tipo_orden')->nullable(); // "CEO. IDEN. N° R.I.F"
        $table->string('orden_servicio_numero')->nullable();
        $table->string('beneficiario'); // "I.V.S.S."
        $table->string('autorizado_cobrar')->nullable(); // "AUTORIZADO A COBRAR"
        $table->text('concepto_gasto'); // "PAGO DE SEGURO SOCIAL..."

        // --- Pie de Página (Cálculos) ---
        $table->decimal('base_satet', 15, 2)->nullable();
        $table->decimal('retencion_satet', 15, 2)->nullable();
        $table->string('n_comprobante_retencion')->nullable();
        $table->string('n_transferencia')->nullable();
        $table->decimal('base_iva', 15, 2)->nullable();
        $table->decimal('total_iva', 15, 2)->nullable();
        $table->decimal('ret_iva', 15, 2)->nullable();
        $table->decimal('monto_a_pagar', 15, 2); // "MONTO A PAGAR"

        // --- Firmas (Estos podrían ser estáticos) ---
        $table->string('administrador_nombre')->default('LCDO. GUIDO PEREZ');
        $table->string('presidente_nombre')->default('LCDO. MANUEL MARQUEZ');
        
        $table->text('observaciones')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_compras');
    }
};
