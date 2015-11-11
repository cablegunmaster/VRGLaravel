<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsofinterest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pointsofinterest', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('incident_id');
            $table->integer('task_id');
            $table->text('feature');
            $table->integer('poi_type')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('poi_type')->references('id')->on('poi_type');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pointsofinterest', function(Blueprint $table) {
            $table->dropForeign('pointsofinterest_poi_type_foreign');
        });
    }
}
