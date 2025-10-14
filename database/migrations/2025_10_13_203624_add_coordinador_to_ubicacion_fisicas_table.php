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
        Schema::table('ubicacion_fisicas', function (Blueprint $table) {
            $table->string('coordinador')->after('ubicacion_fisica')->nullable();
            $table->string('titulo')->after('coordinador')->nullable();
            $table->string('cedula')->after('titulo')->nullable();
            $table->string('telefono')->after('cedula')->nullable();
            $table->string('correo')->after('telefono')->nullable();
            $table->boolean('constancia')->after('correo')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ubicacion_fisicas', function (Blueprint $table) {
            $table->dropColumn('coordinador');
            $table->dropColumn('titulo');
            $table->dropColumn('cedula');
            $table->dropColumn('telefono');
            $table->dropColumn('correo');
        });
    }
};
