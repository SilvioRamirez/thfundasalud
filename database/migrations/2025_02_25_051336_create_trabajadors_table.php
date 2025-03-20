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
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->id();
            $table->string('nro')->nullable();
            $table->string('cedula')->nullable();
            $table->string('nombre')->nullable();
            $table->string('codigo_rac')->nullable();
            $table->string('cargo')->nullable();
            $table->string('dependencia')->nullable();
            $table->string('fecha_ingreso')->nullable();
            $table->string('anos_anteriores')->nullable();
            $table->string('banco')->nullable();
            $table->string('cuenta')->nullable();
            $table->string('nomina')->nullable();
            $table->string('mes')->nullable();
            $table->string('ano')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadors');
    }
};
