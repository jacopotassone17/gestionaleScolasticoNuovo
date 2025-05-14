<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIdStudenteAutoIncrement extends Migration
{
    public function up()
    {
        Schema::table('studente', function (Blueprint $table) {
            $table->bigIncrements('id_studente')->change(); // Rende auto-increment
        });
    }

    public function down()
    {
        Schema::table('studente', function (Blueprint $table) {
            $table->dropColumn('id_studente'); // Rimuovi la colonna auto-increment
        });
    }
}
