<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id();
            $table->string('english_question')->nullable();
            $table->string('hindi_question')->nullable();
            $table->string('english_option_one')->nullable();
            $table->string('hindi_option_one')->nullable();
            $table->string('english_option_two')->nullable();
            $table->string('hindi_option_two')->nullable();
            $table->string('english_option_three')->nullable();
            $table->string('hindi_option_three')->nullable();
            $table->string('english_option_four')->nullable();
            $table->string('hindi_option_four')->nullable();
            $table->string('answer')->nullable();
            $table->integer('marks')->nullable();
            $table->enum('status', [0,1])->default(0);
            $table->integer('company')->nullable();;
            $table->integer('exam_set')->nullable();
            $table->integer('category')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('exam_questions');
    }
};
