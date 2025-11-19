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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('direccion_envio_id');
            $table->string('metodo_pago'); // tarjeta, yape, plin, transferencia
            $table->decimal('monto', 10, 2);
            $table->string('estado')->default('pendiente'); // pendiente / pagado
            $table->string('codigo_operacion')->nullable(); // para yape/plin
            $table->string('numero_tarjeta')->nullable();
            $table->string('nombre_titular')->nullable();
            $table->string('vencimiento')->nullable();
            $table->string('cvv')->nullable();
            $table->string('comprobante')->nullable(); // imagen en yape/plin/transferencia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
