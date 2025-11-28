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
        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreignId('cupon_id')
                ->nullable()
                ->after('pago_id')
                ->constrained('cupones')
                ->onDelete('set null');

            $table->string('codigo_cupon')
                ->nullable()
                ->after('cupon_id');

            $table->decimal('descuento', 10, 2)
                ->default(0)
                ->after('codigo_cupon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['cupon_id']);
            $table->dropColumn(['cupon_id', 'codigo_cupon', 'descuento']);
        });
    }
};
