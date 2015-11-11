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
            $table->integer('task_type_id');
            $table->integer('team_id');
            $table->String('title')->nullable();
            $table->text('description')->nullable();
            $table->text('data');// voor JSON data mallen,
            $table->timestamp('end_date')->nullable()->default(null);
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
