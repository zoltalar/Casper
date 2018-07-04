<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMakesTable extends Migration
{
    public function up()
    {
        Schema::create('makes', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 100)->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('makes');
    }
}
