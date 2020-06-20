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
            $table->foreignId('load_id');
            $table->string('load_type');//stop1 pick up ,delivery
            $table->string('stop_description');//pick up hash
            $table->string('trailer_type'); //stop2 live load , drop trailer
            $table->string('facility');
            $table->string('address');
            $table->string('contact');
            $table->string('phone');
            $table->string('appointment_type');
            $table->text('driver_work');
            $table->text('facility_note');
            $table->foreign('load_id')->references('id')->on('loads')->onDelete('cascade');

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
        Schema::dropIfExists('load_stops');
    }
}
