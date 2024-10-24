<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstFavoriseToElevesTable extends Migration
{
    public function up()
    {
        Schema::table('eleves', function (Blueprint $table) {
            $table->string('est_favorise')->nullable(); // "favorise" or null
        });
    }

    public function down()
    {
        Schema::table('eleves', function (Blueprint $table) {
            $table->dropColumn('est_favorise');
        });
    }
}
