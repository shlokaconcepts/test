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
        Schema::create('user_assessments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('assessment_date',10)->nullable();
            $table->integer('aptitude')->length(6)->nullable();
            $table->integer('behavior')->length(6)->nullable();
            $table->integer('technical')->length(6)->nullable();
            $table->integer('aptitude_passing_mark')->length(6)->nullable();
            $table->integer('behavior_passing_mark')->length(6)->nullable();
            $table->integer('technical_passing_mark')->length(6)->nullable();
            $table->integer('total_mark')->length(4)->nullable();
            $table->enum('result', ['FAIL','PASS'])->nullable();
            $table->enum('assessment_status', ['Pending','Attempt','Not Attempt'])->default('Not Attempt');
            $table->string('mark_updated_by',30)->nullable();
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
        Schema::dropIfExists('user_assessments');
    }
};
