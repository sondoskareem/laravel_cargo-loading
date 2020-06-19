<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->date('birth');
            $table->string('driver');
            $table->string('home_terminal');
            $table->string('dl_hash');
            $table->string('endorsements');
            $table->boolean('hazmat');
            $table->boolean('tanker');
            $table->boolean('double_triple');
            $table->date('dl_exp');
            $table->date('medical_exp');
            $table->integer('paye_rate');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
