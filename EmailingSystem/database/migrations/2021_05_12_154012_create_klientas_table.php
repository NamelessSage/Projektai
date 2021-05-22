<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlientasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klientas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('vardas');
            $table->string('pavarde');
            $table->string('elpastas');
            $table->string('kategorija')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('klientas');
    }
}
