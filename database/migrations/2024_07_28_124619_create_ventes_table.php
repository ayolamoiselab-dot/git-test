<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->string('nom_acheteur');
            $table->integer('macarons')->default(0);
            $table->integer('tshirts')->default(0);
            $table->float('tissu_bleu')->default(0);
            $table->float('tissu_jaune')->default(0);
            $table->integer('total')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventes');
    }
}
