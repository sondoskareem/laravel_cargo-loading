<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('load_id');
            $table->string('load_type');//stop1 pick up ,delivery
            $table->string('stop_description');//pick up hash
            $table->string('trailer_type'); //stop2 live load , drop trailer
            $table->string('facility');
            $table->string('address');
            $table->integer('phone');
            $table->string('appointment_type');
            $table->text('driver_work');
            $table->boolean('is_deleted')->default(false);
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
        Schema::dropIfExists('breaks');
    }
}
