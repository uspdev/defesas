<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTituloAndTitleToAgendamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->string('titulo',250)->change();
	    $table->string('title',250)->change();
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
	    $table->string('titulo');
	    $table->string('title');
        });
    }
}
