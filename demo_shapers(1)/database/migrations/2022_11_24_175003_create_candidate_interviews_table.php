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
        Schema::create('candidate_interviews', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->integer('interviewer_id')->nullable();
            $table->string('interview_date',10)->nullable();
            $table->string('interview_start_time',10)->nullable();
            $table->string('interview_taking_time',10)->nullable();
            $table->string('physical_appearance',100)->nullable()->comment('Overall Built, Grooming, Body Language');
            $table->string('communication',100)->nullable()->comment('Ability to understand & communicate in Hindi');
            $table->string('family_background',100)->nullable()->comment('Annual Income, Education Background');
            $table->string('subject_knowledge',100)->nullable()->comment('Theoretical / Practical Knowledge, Basics of ITI Trade, Safety norms');
            $table->string('previous_experience',100)->nullable()->comment('Nature of job, Relevant experience, Learnings');
            $table->string('discipline',100)->nullable()->comment('Values punctuality, Follows rules & instructions');
            $table->string('positive_attitude',100)->nullable()->comment('Avoids conflict, Does not indulge in aggressive behavior');
            $table->string('need_for_job',100)->nullable()->comment('Prefers defined job role');
            $table->string('remark')->nullable();
            $table->enum('status', ['Selected','Rejected','Hold','Absent'])->nullable();
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('candidate_interviews');
    }
};
