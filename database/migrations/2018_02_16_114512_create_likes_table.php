<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();

            $table->integer('salon_id')->unsigned();

            $table->primary(['user_id','salon_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('salon_id')
                ->references('id')
                ->on('salons')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->timestamps();
        });
        //DB::unprepared('ALTER TABLE `likes` DROP PRIMARY KEY, ADD PRIMARY KEY (`user_id`, `salon_id`)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
