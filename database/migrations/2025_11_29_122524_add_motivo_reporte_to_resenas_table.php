<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('resenas', function (Blueprint $table) {
            $table->string('motivo_reporte')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('resenas', function (Blueprint $table) {
            $table->dropColumn('motivo_reporte');
        });
    }
};


