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
            $table->decimal('bono_navideno', total: 8, places: 2)->nullable()->after('aguinaldos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('segunda_quincenas', function (Blueprint $table) {
            $table->dropColumn('bono_navideno');
        });
    }
};
