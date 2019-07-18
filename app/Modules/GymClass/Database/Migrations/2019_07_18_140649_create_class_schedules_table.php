<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('class_type_id')->nullable();
            $table->unsignedBigInteger('activities_id')->nullable();
            $table->integer('level')->nullable();
            $table->integer('credits')->nullable();
            $table->date('booking_date')->nullable();
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();

            $table->foreign('class_type_id')
                ->references('id')
                ->on('class_types')
                ->onDelete('cascade');

            $table->foreign('activities_id')
                ->references('id')
                ->on('activities')
                ->onDelete('cascade');

            $table->foreign('trainer_id')
                ->references('id')
                ->on('trainers')
                ->onDelete('cascade');

            $table->index(['start_at', 'end_at']);
            $table->index(['booking_date', 'start_at', 'end_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_schedules');
    }
}
