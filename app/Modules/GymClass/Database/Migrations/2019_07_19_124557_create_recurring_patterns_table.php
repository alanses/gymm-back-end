<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurringPatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurring_patterns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('class_schedule_id')->nullable();
            $table->unsignedBigInteger('recurring_type_id')->nullable();

            $table->integer('day_of_week')->nullable();
            $table->integer('week_of_month')->nullable();
            $table->integer('day_of_month')->nullable();
            $table->integer('month_of_year')->nullable();

            $table->timestamps();

            $table->foreign('class_schedule_id')
                ->references('id')
                ->on('class_schedules')
                ->onDelete('cascade');

            $table->foreign('recurring_type_id')
                ->references('id')
                ->on('recurring_types')
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
        Schema::dropIfExists('recurring_patterns');
    }
}
