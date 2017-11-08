<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->date('date');
            $table->time('time')->nullable();
            $table->boolean('all_day')->default(0)->nullable();
            $table->string('address', 100);
            $table->string('address_2', 100)->nullable();
            $table->string('city', 60);
            $table->integer('state_id')->unsigned()->nullable();
            $table->string('postal_code', 15);
            $table->boolean('public')->default(0)->nullable();
            $table->timestamps();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();

            $table->foreign('state_id', 'fk_events_states')
                ->references('id')
                ->on('states')
                ->onDelete('set null');

            $table->foreign('created_by', 'fk_events_creators')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('updated_by', 'fk_events_editors')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
