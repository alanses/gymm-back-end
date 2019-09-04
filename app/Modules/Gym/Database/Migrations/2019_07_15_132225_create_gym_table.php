<?php

use App\Modules\Gym\Entities\Gym;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gyms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->unique();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('available_from')->nullable();
            $table->timestamp('available_to')->nullable();

            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            $table->smallInteger('is_available')->default(Gym::$IS_NOT_AVAILABLE);

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('gym');
    }
}
