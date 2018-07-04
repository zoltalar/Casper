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
            $table->smallInteger('make_id')->unsigned();
            $table->string('model', 100);

            $table->unique(['make_id', 'model']);

            $table->foreign('make_id')
                ->references('id')
                ->on('makes')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
