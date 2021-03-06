<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidence2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence2', function (Blueprint $table) {
            $table->id();
            $table->dateTime('DateTime')->nullable();
            $table->longText('Picture')->nullable();
            $table->longText('Thermal')->nullable();
            $table->string('Temperature')->nullable();
            $table->string('Longitude')->nullable();
            $table->string('Latitude')->nullable();
            $table->bigInteger('report_id')->unsigned()->index()->nullable();
            $table->foreign('report_id')->references('id')->on('report')->onDelete('cascade');
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
        Schema::dropIfExists('evidence2');
    }
}
