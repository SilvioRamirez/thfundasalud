<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\UbicacionFisica;
use App\Models\Trabajador;
use App\Models\Municipio;
use App\Models\Parroquia;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fe_de_vidas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Trabajador::class)->nullable();
            $table->foreignIdFor(UbicacionFisica::class)->nullable();
            $table->foreignIdFor(Municipio::class)->nullable();
            $table->foreignIdFor(Parroquia::class)->nullable();
            $table->string('ubicacion_fisica_funcion')->nullable();
            $table->foreignId('jefe_inmediato_id')->constrained('trabajadors')->nullable();
            $table->foreignId('registered_by')->constrained('users')->nullable();
            $table->string('image_url')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fe_de_vidas');
    }
};
