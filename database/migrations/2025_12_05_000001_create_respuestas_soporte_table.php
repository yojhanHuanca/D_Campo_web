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
        Schema::create('respuestas_soporte', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_soporte_id');
            $table->unsignedBigInteger('user_id')->nullable(); // admin que responde
            $table->string('origen', 20)->default('manual'); // manual | ia
            $table->text('contenido');
            $table->timestamps();

            $table->foreign('consulta_soporte_id')
                ->references('id')
                ->on('consulta_soportes')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas_soporte');
    }
};
