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
        Schema::table('segunda_quincenas', function (Blueprint $table) {
            $table->decimal('retroactivo_mes_en_curso', total: 8, places: 2)->nullable()->after('retroactivo_meses_anteriores');
            $table->decimal('aguinaldos', total: 8, places: 2)->nullable()->after('retroactivo_mes_en_curso');
            $table->decimal('bono_dia_del_obrero', total: 8, places: 2)->nullable()->after('aguinaldos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('segunda_quincenas', function (Blueprint $table) {
            $table->dropColumn('retroactivo_mes_en_curso');
            $table->dropColumn('aguinaldos');
            $table->dropColumn('bono_dia_del_obrero');
        });
    }
};
