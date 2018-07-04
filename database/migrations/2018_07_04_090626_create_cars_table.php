<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('make', 100);
            $table->string('model', 100);

            $table->unique(['make', 'model']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
