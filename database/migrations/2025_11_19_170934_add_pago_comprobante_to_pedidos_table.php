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
            $table->string('comprobante')->nullable()->after('estado');
            $table->string('codigo_operacion')->nullable()->after('comprobante');
            $table->string('metodo_pago')->nullable()->after('codigo_operacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn(['comprobante', 'metodo_pago']);
        });
    }
};
