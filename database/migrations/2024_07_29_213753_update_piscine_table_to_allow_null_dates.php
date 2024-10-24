<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePiscineTableToAllowNullDates extends Migration
{
    public function up()
    {
        Schema::table('piscine', function (Blueprint $table) {
            $table->date('date_versement1')->nullable()->change();
            $table->date('date_versement2')->nullable()->change();
            $table->date('date_versement3')->nullable()->change();
            $table->date('date_versement4')->nullable()->change();
            $table->date('date_versement5')->nullable()->change();
            $table->date('date_versement6')->nullable()->change();
            $table->date('date_versement7')->nullable()->change();
            $table->date('date_versement8')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('piscine', function (Blueprint $table) {
            $table->date('date_versement1')->nullable(false)->change();
            $table->date('date_versement2')->nullable(false)->change();
            $table->date('date_versement3')->nullable(false)->change();
            $table->date('date_versement4')->nullable(false)->change();
            $table->date('date_versement5')->nullable(false)->change();
            $table->date('date_versement6')->nullable(false)->change();
            $table->date('date_versement7')->nullable(false)->change();
            $table->date('date_versement8')->nullable(false)->change();
        });
    }
}
