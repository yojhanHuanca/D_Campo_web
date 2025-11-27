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
        Schema::create('cupones', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->unique();
    
            // TIPO DE DESCUENTO: porcentaje o monto
            $table->enum('tipo', ['porcentaje', 'monto']);
    
            // VALOR DEL DESCUENTO (10 = 10%, 20 = 20%, o 50 = S/50)
            $table->decimal('valor', 8, 2);
    
            // DESCRIPCIÓN DEL CUPÓN (lo que sale debajo del código)
            $table->string('descripcion')->nullable();
    
            // COMPRA MÍNIMA PARA APLICAR EL CUPÓN
            $table->decimal('compra_minima', 10, 2)->default(0);
    
            // FECHAS
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
    
            // LÍMITES Y USOS
            $table->integer('limite_uso')->nullable();
            $table->integer('usos_realizados')->default(0);
    
            // ESTADO
            $table->boolean('activo')->default(true);
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupones');
    }
};
