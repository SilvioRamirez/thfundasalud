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
        Schema::table('primera_quincenas', function (Blueprint $table) {
            $table->decimal('prima_por_hijos', total: 8, places: 2)->nullable()->after('bono_de_uniformes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('primera_quincenas', function (Blueprint $table) {
            $table->dropColumn('prima_por_hijos');
        });
    }
};
