<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeAndDatesToCafetariatsTable extends Migration
{
    public function up()
    {
        Schema::table('cafetariat', function (Blueprint $table) {
            $table->string('type_paiement')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
        });
    }

    public function down()
    {
        Schema::table('cafetariat', function (Blueprint $table) {
            $table->dropColumn(['type_paiement', 'date_debut', 'date_fin']);
        });
    }
}
