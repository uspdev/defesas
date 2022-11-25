<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Agendamento;

class AddColumnStatusInAgendamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->string('approval_status')->nullable();
        });
        $agendamentos = Agendamento::all();
        foreach($agendamentos as $agendamentos){
            $agendamento->status = 'Aprovado';
            $agendamento->save();
        }
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->string('approval_status')->required();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });
    }
}
