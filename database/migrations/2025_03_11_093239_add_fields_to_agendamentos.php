<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Agendamento;
use Uspdev\Replicado\DB as DBreplicado;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->integer('codare')->nullable();
            $table->char('nivpgm', 2)->nullable();
            $table->integer('numseqpgm')->nullable();
        });

        $agendamentos = Agendamento::all(['id', 'codpes', 'nivel']);
        foreach($agendamentos as $agendamento) {

            $query = "SELECT A.codpes, A.codare, A.nivpgm, A.numseqpgm
                    FROM AGPROGRAMA A
                    WHERE A.codpes = convert(int, :codpes)
                    AND A.vinalupgm = 'REGULAR'
                    AND A.dtaaprbantrb IS NOT NULL";
            $param = [
                'codpes'    => $agendamento->codpes,
            ];

            $agprogramas = DBreplicado::fetchAll($query, $param);

            foreach($agprogramas as $agprograma) {
                $nivpgm = $agprograma['nivpgm'] == 'ME' ? 'Mestrado' : 'Doutorado';
                if($agendamento->nivel == $nivpgm) {
                    $agendamento->codare = $agprograma['codare'];
                    $agendamento->nivpgm = $agprograma['nivpgm'];
                    $agendamento->numseqpgm = $agprograma['numseqpgm'];
                    $agendamento->save();
                }
            }
        }
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
