<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function(Blueprint $table){
            $table->increments('id');
            $table->integer('incident_id');
            $table->integer('team_id');
            $table->integer('task_type_id');
            $table->String('title');
            $table->text('description');
            $table->text('data');// voor JSON data mallen,
            $table->double('dest_lat');
            $table->double('dest_lon');
            $table->String('dest_text', 128);
            $table->timestamp('end_date');
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
        Schema::drop('task');
    }
}
