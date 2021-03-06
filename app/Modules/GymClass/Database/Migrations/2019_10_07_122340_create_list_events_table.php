<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('class_type_id')->nullable();
            $table->unsignedBigInteger('activities_id')->nullable();
            $table->integer('level')->nullable();
            $table->integer('credits')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();

            $table->char('is_full_day_event', '1')->nullable();
            $table->char('is_recurring', '1')->nullable();
            $table->unsignedBigInteger('recurring_type_id')->nullable();

            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->integer('count_persons')->default(0);
            $table->integer('max_count_persons')->nullable();
            $table->unsignedBigInteger('gym_id')->nullable();

            $table->string('file_name')->nullable();
            $table->string('origin_name')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();

            $table->foreign('class_type_id')
                ->references('id')
                ->on('class_types')
                ->onDelete('cascade');

            $table->foreign('recurring_type_id')
                ->references('id')
                ->on('recurring_types')
                ->onDelete('cascade');

            $table->foreign('activities_id')
                ->references('id')
                ->on('activities')
                ->onDelete('cascade');

            $table->foreign('trainer_id')
                ->references('id')
                ->on('trainers')
                ->onDelete('cascade');

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
        Schema::dropIfExists('list_events');
    }
}
