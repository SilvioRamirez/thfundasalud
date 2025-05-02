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
        Schema::create('eleccion_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleccion_id')->constrained();
            $table->foreignId('trabajador_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamp('voto_at')->useCurrent()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['eleccion_id', 'trabajador_id']); //El trabajador puede participar en una sola elección
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleccion_participants');
    }
};
