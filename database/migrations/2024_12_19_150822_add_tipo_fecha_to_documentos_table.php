<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoFechaToDocumentosTable extends Migration
{
    public function up()
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->string('tipo')->nullable();
            $table->date('fecha')->nullable();
        });
    }

    public function down()
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->dropColumn('tipo');
            $table->dropColumn('fecha');
        });
    }
}
