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
        Schema::create('segunda_quincenas', function (Blueprint $table) {
            $table->id();
            $table->string('nro')->nullable();
            $table->string('cedula')->nullable();
            $table->decimal('sueldo_base_quincenal', total: 8, places: 2)->nullable();
            $table->decimal('diferencia_de_sueldo_por_funcion_quincenal', total: 8, places: 2)->nullable();
            $table->decimal('compensacion_por_evaluacion_quincenal', total: 8, places: 2)->nullable();
            $table->decimal('evaluacion_por_compensacion_2do_semestre_2024_julio_diciembre', total: 8, places: 2)->nullable();
            $table->decimal('escalafon_medico_quincenal', total: 8, places: 2)->nullable();
            $table->decimal('escalafon_asistencial_quincenal', total: 8, places: 2)->nullable();
            $table->decimal('prima_daspuns_quincenal', total: 8, places: 2)->nullable();
            $table->decimal('prima_por_antiguedad_quincenal', total: 8, places: 2)->nullable();
            $table->decimal('prima_por_profesionalizacion_quincenal', total: 8, places: 2)->nullable();
            $table->decimal('dia_adicional', total: 8, places: 2)->nullable();
            $table->decimal('bono_nocturno_por_guardia', total: 8, places: 2)->nullable();
            $table->decimal('bono_nocturno_fijo', total: 8, places: 2)->nullable();
            $table->decimal('domingo_y_feriados_por_guardia', total: 8, places: 2)->nullable();
            $table->decimal('bono_vacacional', total: 8, places: 2)->nullable();
            $table->decimal('prima_por_hijos', total: 8, places: 2)->nullable();
            $table->decimal('jerarquia_o_responsabilidad_empleado', total: 8, places: 2)->nullable();
            $table->decimal('bono_del_dia_del_nino', total: 8, places: 2)->nullable();
            $table->decimal('bono_del_dia_del_padre', total: 8, places: 2)->nullable();
            $table->decimal('bono_del_dia_de_la_madre', total: 8, places: 2)->nullable();
            $table->decimal('bono_de_uniformes', total: 8, places: 2)->nullable();
            $table->decimal('retroactivo_meses_anteriores', total: 8, places: 2)->nullable();
            $table->decimal('total_asignaciones', total: 8, places: 2)->nullable();
            $table->decimal('catset', total: 8, places: 2)->nullable();
            $table->decimal('cahorminsas', total: 8, places: 2)->nullable();
            $table->decimal('asociacion_cooperativa_trujillo', total: 8, places: 2)->nullable();
            $table->decimal('asociacion_cooperativa_valera', total: 8, places: 2)->nullable();
            $table->decimal('pension_por_manutencion', total: 8, places: 2)->nullable();
            $table->decimal('sinboproenf', total: 8, places: 2)->nullable();
            $table->decimal('surbsset', total: 8, places: 2)->nullable();
            $table->decimal('sunepsas', total: 8, places: 2)->nullable();
            $table->decimal('impreenfermeras_valera', total: 8, places: 2)->nullable();
            $table->decimal('impreenfermeras_trujillo', total: 8, places: 2)->nullable();
            $table->decimal('colegio_de_enfermeria_trujillo', total: 8, places: 2)->nullable();
            $table->decimal('colegio_de_enfermeras_valera', total: 8, places: 2)->nullable();
            $table->decimal('sitrasalud_trujillo', total: 8, places: 2)->nullable();
            $table->decimal('surtrapps', total: 8, places: 2)->nullable();
            $table->decimal('fenasirtrasalud', total: 8, places: 2)->nullable();
            $table->decimal('sutset', total: 8, places: 2)->nullable();
            $table->decimal('fetrasalud', total: 8, places: 2)->nullable();
            $table->decimal('sso', total: 8, places: 2)->nullable();
            $table->decimal('paro_forzoso', total: 8, places: 2)->nullable();
            $table->decimal('faov', total: 8, places: 2)->nullable();
            $table->decimal('inces', total: 8, places: 2)->nullable();
            $table->decimal('fondo_de_jubilacion', total: 8, places: 2)->nullable();
            $table->decimal('total_deduciones', total: 8, places: 2)->nullable();
            $table->decimal('total', total: 8, places: 2)->nullable();
            $table->string('filtro')->nullable();
            $table->string('ano')->nullable();
            $table->string('mes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('segunda_quincenas');
    }
};
