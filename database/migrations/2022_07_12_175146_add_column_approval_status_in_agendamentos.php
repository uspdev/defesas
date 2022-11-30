<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Agendamento;

class AddColumnApprovalStatusInAgendamentos extends Migration
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

        //Agendamento::update([approval_status' => 'Aprovado']);
        DB::raw("UPDATE agendamentos Set approval_status='Aprovado'");

        Schema::table('agendamentos', function (Blueprint $table) {
            $table->string('approval_status')->required()->change();
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
