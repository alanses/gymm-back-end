<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassScheduleDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_schedule_description', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('class_schedule_id')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('full_class_type_id')->nullable();
            $table->timestamps();

            $table->foreign('class_schedule_id')
                ->references('id')
                ->on('class_schedules')
                ->onDelete('cascade');

            $table->foreign('full_class_type_id')
                ->references('id')
                ->on('full_class_types')
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
        Schema::dropIfExists('class_schedule_description');
    }
}
