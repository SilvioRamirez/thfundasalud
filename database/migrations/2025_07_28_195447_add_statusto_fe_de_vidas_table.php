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
        Schema::table('fe_de_vidas', function (Blueprint $table) {
            $table->string('status')->after('registered_by')->default('Registrado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fe_de_vidas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
