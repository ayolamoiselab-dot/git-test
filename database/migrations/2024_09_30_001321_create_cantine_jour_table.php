<?php

// database/migrations/xxxx_xx_xx_create_cantine_jour_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCantineJourTable extends Migration
{
    public function up()
    {
        Schema::create('cantine_jour', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('classe');
            $table->enum('type_paiement', ['jour', 'semaine']);
            $table->decimal('montant', 10, 2);
            $table->date('date_jour')->nullable(); // Pour le paiement journalier
            $table->date('date_debut')->nullable(); // Pour la semaine
            $table->date('date_fin')->nullable(); // Pour la semaine
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cantine_jour');
    }
}
