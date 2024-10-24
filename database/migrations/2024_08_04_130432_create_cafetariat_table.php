<?php

// database/migrations/2024_08_03_000000_create_cafetariat_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCafetariatTable extends Migration
{
    public function up()
    {
        Schema::create('cafetariat', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('classe');
            $table->date('date')->nullable();
            $table->decimal('montant', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cafetariat');
    }
}
