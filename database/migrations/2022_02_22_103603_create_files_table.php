<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('original_name');
            $table->string('path');
            $table->string('tipo');
            $table->string('url');
            $table->integer('status');
            $table->foreignId('user_id_admin')->constrained('users');
            $table->foreignId('user_id_biblioteca')->constrained('users');
            $table->integer('agendamento_id')->unsigned();
            $table->foreign('agendamento_id')->references('id')->on('agendamentos');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
