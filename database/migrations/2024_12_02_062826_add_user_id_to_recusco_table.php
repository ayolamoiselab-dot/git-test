<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   // database/migrations/xxxx_xx_xx_add_user_id_to_recusco_table.php
public function up()
{
    Schema::table('recusco', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable(); // Associe l'utilisateur
        $table->foreign('user_id')->references('id')->on('users'); // Clé étrangère
    });
}

public function down()
{
    Schema::table('recusco', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}

};
