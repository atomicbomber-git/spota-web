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
            $table->string('title',255);
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
            $table->text('description');
            $table->string('file');
            $table->unsignedInteger('major_id')->nullable();
            $table->foreign('major_id')->references('id')->on('majors')->onDelete('set null');
            $table->unsignedInteger('expertise_id')->nullable();
            $table->foreign('expertise_id')->references('id')->on('expertises');
            $table->unsignedInteger('suggestor')->nullable();   //Rekomendasi Dosen
            $table->foreign('suggestor')->references('id')->on('lecturers')->onDelete('set null');
            $table->string('semester');         
            $table->string('semesters_year');   //tahun ajaran
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
