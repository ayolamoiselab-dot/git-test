<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumeroDecaissementToDecaissementsTable extends Migration
{
    public function up()
    {
        Schema::table('decaissements', function (Blueprint $table) {
            $table->string('numero_decaissement')->unique()->after('id');
        });
    }

    public function down()
    {
        Schema::table('decaissements', function (Blueprint $table) {
            $table->dropColumn('numero_decaissement');
        });
    }
}
