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
        Schema::create('pointsOfInterest', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('incident_id');
            $table->integer('task_id');
            $table->double('lat'); // X coordinate.
            $table->double('lon'); // Y coordinate.
            $table->integer('poi_type')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('poi_type')->references('id')->on('POI_Type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pointsOfInterest', function(Blueprint $table) {
            $table->dropForeign('pointsofinterest_poi_type_foreign');
        });
    }
}
