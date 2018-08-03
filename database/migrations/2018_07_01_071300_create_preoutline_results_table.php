<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreoutlineResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preoutline_results', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('preoutline_id');
            $table->foreign('preoutline_id')->references('id')->on('preoutlines')->onDelete('cascade');
            $table->enum('result',['approved','disapproved','aborted']);
            $table->string('final_title');
            $table->unsignedInteger('first_supervisor')->nullable(); //pembimbing 1
            $table->foreign('first_supervisor')->references('id')->on('users')->onDelete('set null');
            $table->unsignedInteger('second_supervisor')->nullable(); //pembimbing 2
            $table->foreign('second_supervisor')->references('id')->on('users')->onDelete('set null');
            $table->unsignedInteger('first_examiner')->nullable(); //pembimbing 1
            $table->foreign('first_examiner')->references('id')->on('users')->onDelete('set null');
            $table->unsignedInteger('second_examiner')->nullable(); //pembimbing 1
            $table->foreign('second_examiner')->references('id')->on('users')->onDelete('set null');
            $table->timestamp('result_date');
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
        Schema::dropIfExists('preoutline_results');
    }
}
