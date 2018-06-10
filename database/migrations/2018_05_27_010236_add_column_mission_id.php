<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnMissionId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('depences', function (Blueprint $table) {
          $table->integer('mission_id')->unsigned()->after('montant');
          $table->foreign('mission_id')->references('id')->on('missions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('depences', function (Blueprint $table) {
            //
        });
    }
}
