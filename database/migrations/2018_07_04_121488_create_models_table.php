<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration
{
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->smallInteger('make_id')->unsigned();
            $table->string('name', 100)->unique();

            $table->foreign('make_id')
                ->references('id')
                ->on('makes')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('models');
    }
}
