<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateChauffeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chauffeurs', function (Blueprint $table) {
            $table->id();
			$table->string('nom');
			$table->string('prenom');
			$table->string('adresse');
			$table->string('email')->unique();
            $table->string('password');
			$table->string('tel');
			$table->date('date_naissance');
			$table->bigInteger('num_permis');
			$table->string('etat')->default("D");
            $table->foreignId('vehicule_id')->constrained();
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
        Schema::dropIfExists('chauffeurs');
    }
}
