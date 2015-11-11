<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLonLatToIncident extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incident', function (Blueprint $table) {
            $table->double('weather');
            $table->double('weather');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incident', function (Blueprint $table) {
            $table->dropColumn('weather');
            $table->dropColumn('weather');
        });
    }
}
