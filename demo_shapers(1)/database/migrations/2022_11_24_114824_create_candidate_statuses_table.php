<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('candidate_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->enum('admit_card_status',['Not Generated','Generated'])->default('Not Generated');
            $table->enum('document_status',['Pending','Absent','Verified','Reject'])->default('Pending');
            $table->string('document_result',50)->nullable();
            $table->string('document_verify_by',50)->nullable();

            $table->enum('assessment_status',['Not Assigned','Pending','Absent','Completed'])->default('Not Assigned');
            $table->enum('assessment_result',['Pass','Fail','Pending'])->default('Pending');
            $table->string('assessment_assign_by',50)->nullable();
            $table->string('assessment_date',10)->nullable();
            $table->enum('interview_status',['Pending','Absent','Completed'])->default('Pending');
            $table->string('interview_result',100)->nullable();
            $table->string('interview_date',10)->nullable();
            $table->enum('onboarding_status',['Pending','Absent','Completed'])->default('Pending');
            $table->string('onboarding_result',100)->nullable();
            $table->string('onboarding_date',10)->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('candidate_statuses');
    }
};
