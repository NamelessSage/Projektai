<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuplanuotisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suplanuotis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('klientas_id');
            $table->unsignedBigInteger('sablonas_id');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('last_sent')->nullable();
            $table->string('how_long')->nullable();
            $table->string('frequency')->nullable();
            $table->string('repeat');

            $table->foreign('klientas_id')->references('id')->on('klientas')->onDelete('cascade');
            $table->foreign('sablonas_id')->references('id')->on('sablonas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suplanuotis');
    }
}
