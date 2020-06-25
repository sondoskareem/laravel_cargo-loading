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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('position_id');
            $table->string('birth');
            $table->string('home_terminal');
            $table->string('dl_hash');
            $table->string('state');
            $table->string('endorsements');
            $table->boolean('hazmat');
            $table->boolean('tanker');
            $table->boolean('double_triple');
            $table->string('dl_exp');
            $table->string('medical_exp');
            $table->integer('pay_rate');
            $table->string('profile_image');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions');

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
        Schema::dropIfExists('drivers');
    }
}
