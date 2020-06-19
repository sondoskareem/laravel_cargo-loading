<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoadStopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('load_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('car_type');
            $table->timestamps();
            $table->foreign('factoring_id')->references('id')->on('factorings');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('load_stops');
    }
}
