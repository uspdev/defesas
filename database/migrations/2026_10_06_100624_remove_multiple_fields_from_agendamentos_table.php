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
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->dropColumn([
                'nome',
                'regimento',
                'orientador_votante',
                'nivel',
                'titulo',
                'area_programa',
                'orientador',
                'resumo',
                'palavras_chave',
                'title',
                'co_orientador',
                'nome_co_orientador',
                'approval_status'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agendamentos', function (Blueprint $table) {
            //
        });
    }
};
