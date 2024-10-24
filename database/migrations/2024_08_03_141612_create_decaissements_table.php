<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecaissementsTable extends Migration
{
    public function up()
    {
        Schema::create('decaissements', function (Blueprint $table) {
            $table->id();
            $table->string('nom_decaissier');
            $table->string('nom_beneficiaire');
            $table->string('type');
            $table->text('libelle');
            $table->date('date')->nullable();
            $table->decimal('montant', 10, 2);
            $table->string('preuve')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('decaissements');
    }
}
