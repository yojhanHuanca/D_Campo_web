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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pago_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('direccion_envio_id')
                ->nullable()
                ->constrained('direcciones_envio')
                ->onDelete('set null');

            $table->string('codigo_seguimiento')->unique();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('igv', 10, 2);
            $table->decimal('envio', 10, 2);
            $table->decimal('total', 10, 2);

            $table->enum('estado', ['pendiente', 'pagado', 'enviado', 'entregado', 'cancelado'])
              ->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
