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
    public function up()
{
    Schema::table('eleves', function (Blueprint $table) {
        $table->decimal('reduction_fcfa', 10, 2)->nullable()->after('est_favorise');
        $table->decimal('reduction_pourcentage', 5, 2)->nullable()->after('reduction_fcfa');
    });

    Schema::table('cantine', function (Blueprint $table) {
        $table->decimal('reduction_fcfa', 10, 2)->nullable()->after('est_favorise_cantine');
        $table->decimal('reduction_pourcentage', 5, 2)->nullable()->after('reduction_fcfa');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eleves_and_cantine', function (Blueprint $table) {
            //
        });
    }
};
