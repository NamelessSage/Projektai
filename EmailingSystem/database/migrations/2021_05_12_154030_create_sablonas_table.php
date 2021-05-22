<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSablonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sablonas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('sablonas');
            $table->string('pavadinimas');
            $table->string('tema');
            $table->string('parasas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sablonas');
    }
}
