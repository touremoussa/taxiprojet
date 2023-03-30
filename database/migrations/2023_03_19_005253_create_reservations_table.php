<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
			$table->foreignId('client_id')->constrained();
			$table->foreignId('chauffeur_id')->nullable()->constrained();
			$table->float('dure');
            $table->float('distance');
			$table->string('adresse_depart');
			$table->string('adresse_arrivee');
			$table->float('d_longitude', 8, 2)->nullable();
			$table->float('d_latitude', 8, 2)->nullable();
			$table->float('a_longitude', 8, 2)->nullable();
			$table->float('a_latitude', 8, 2)->nullable();
			$table->float('prix');
			$table->string('etat')->default("A");
            // A: en attente, C: en cours, T: terminé
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
