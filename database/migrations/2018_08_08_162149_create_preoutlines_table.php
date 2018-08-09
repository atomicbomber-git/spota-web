<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreoutlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preoutlines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
            $table->text('description');
            $table->string('file');
            $table->unsignedInteger('major_id')->nullable();
            $table->foreign('major_id')->references('id')->on('majors')->onDelete('set null');
            $table->unsignedInteger('expertise_id')->nullable();
            $table->foreign('expertise_id')->references('id')->on('expertises')->onDelete('set null');
            $table->string('counselor');
            // should have been json data type
            $table->text('info');
            $table->string('semester');         
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
        Schema::dropIfExists('preoutlines');
    }
}
