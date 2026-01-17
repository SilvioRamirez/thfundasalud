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
            $table->decimal('bono_juguetes', total: 8, places: 2)->nullable()->after('aguinaldos');
            $table->decimal('bono_fin_de_ano', 8, 2)->nullable()->after('bono_juguetes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('primera_quincenas', function (Blueprint $table) {            
            $table->dropColumn('bono_juguetes');
            $table->dropColumn('bono_fin_de_ano');
        });
    }
};
