<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
            $table->string('title');
            $table->string('location');
            $table->date('date');
            $table->time('time');
            $table->string('first_supervisor');
            $table->string('second_supervisor');
            $table->string('first_examiner');
            $table->string('second_examiner');
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
        Schema::dropIfExists('schedules');
    }
}
