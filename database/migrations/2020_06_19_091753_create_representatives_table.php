<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factoring_id');
            $table->string('representative');
            $table->integer('rep_phone');
            $table->string('rep_email');
            $table->string('payment_email');
            $table->timestamps();

            $table->foreign('factoring_id')->references('id')->on('factorings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representatives');
    }
}
