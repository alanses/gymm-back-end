<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gym_id');
            $table->string('trainer_name')->nullable();
            $table->integer('level')->nullable();
            $table->integer('cretits_from')->nullable();
            $table->integer('cretits_to')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamps();

            $table->foreign('gym_id')
                ->references('id')
                ->on('gyms')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainers');
    }
}
