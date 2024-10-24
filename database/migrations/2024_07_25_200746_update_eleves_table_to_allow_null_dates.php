<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateElevesTableToAllowNullDates extends Migration
{
    public function up()
    {
        Schema::table('eleves', function (Blueprint $table) {
            $table->date('date_versement1')->nullable()->change();
            $table->date('date_versement2')->nullable()->change();
            $table->date('date_versement3')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('eleves', function (Blueprint $table) {
            $table->date('date_versement1')->nullable(false)->change();
            $table->date('date_versement2')->nullable(false)->change();
            $table->date('date_versement3')->nullable(false)->change();
        });
    }
}
