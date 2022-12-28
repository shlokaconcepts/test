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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id',50)->nullable();
            $table->string('employee_id',35)->nullable();
            $table->string('first_name',40)->nullable();
            $table->string('middle_name',40)->nullable();
            $table->string('last_name',40)->nullable();
            $table->string('full_name',110)->nullable();
            $table->string('dob',10)->nullable();
            $table->string('phone_number',13)->nullable();
            $table->string('alternative_number',13)->nullable();
            $table->string('whats_app_number',13)->nullable();
            $table->text('email')->nullable();
            $table->enum('gender', ['MALE','FEMALE','OTHER'])->default('MALE');
            $table->enum('marital_status', ['Single','Married'])->default('Single');
            $table->enum('category', ['GENERAL','OBC','SC','ST','OTHER'])->default('GENERAL');
            $table->string('aadhar_card',20)->nullable();
            $table->string('pan_card',100)->nullable();
            $table->string('blood_group',3)->nullable();

            // address
            $table->text('present_house_number')->nullable();
            $table->text('present_house_street_village')->nullable();
            $table->integer('present_state')->nullable();
            $table->integer('present_district')->nullable();
            $table->string('present_pincode',10)->nullable();
            $table->text('permanent_house_number')->nullable();
            $table->text('permanent_house_street_village')->nullable();
            $table->integer('permanent_state')->nullable();
            $table->integer('permanent_district')->nullable();
            $table->string('permanent_pincode',10)->nullable();

            // family details
            $table->string('father_name',50)->nullable();
            $table->tinyInteger('father_age')->nullable();
            $table->text('father_occupation')->nullable();
            $table->text('father_annual_income')->nullable();

            $table->string('mother_name',50)->nullable();
            $table->tinyInteger('mother_age')->nullable();
            $table->text('mother_occupation')->nullable();
            $table->text('mother_annual_income')->nullable();

            $table->string('wife_name',50)->nullable();
            $table->tinyInteger('wife_age')->nullable();
            $table->text('wife_occupation')->nullable();
            $table->text('wife_annual_income')->nullable();

            $table->string('s1name',50)->nullable();
            $table->tinyInteger('s1sage')->nullable();
            $table->text('s1soccupation')->nullable();
            $table->text('s1sannualincome')->nullable();
            $table->string('s2name',50)->nullable();
            $table->tinyInteger('s2sage')->nullable();
            $table->text('s2soccupation')->nullable();
            $table->text('s2sannualincome')->nullable();
            $table->string('s3name',50)->nullable();
            $table->tinyInteger('s3sage')->nullable();
            $table->text('s3soccupation')->nullable();
            $table->text('s3sannualincome')->nullable();
            $table->text('child1name')->nullable();
            $table->tinyInteger('child1sage')->nullable();
            $table->text('child2name')->nullable();
            $table->tinyInteger('child2sage')->nullable();
            $table->text('child3name')->nullable();
            $table->tinyInteger('child3sage')->nullable();


            // education details
            $table->text('tenth_college_name')->nullable();
            $table->text('tenth_education_type')->nullable();
            $table->text('tenth_board')->nullable();
            $table->integer('tenth_start_year')->length(11)->nullable();
            $table->integer('tenth_passing_year')->length(11)->nullable();
            $table->text('tenth_score')->nullable();
            $table->text('twelve_college_name')->nullable();
            $table->text('twelve_education_type')->nullable();
            $table->text('twelve_board')->nullable();
            $table->integer('twelve_start_year')->length(11)->nullable();
            $table->integer('twelve_passing_year')->length(11)->nullable();
            $table->text('twelve_score')->nullable();
            $table->text('other_college_name')->nullable();
            $table->text('other_education_type')->nullable();
            $table->integer('other_start_year')->length(11)->nullable();
            $table->integer('other_passing_year')->length(11)->nullable();
            $table->text('other_score')->nullable();
            $table->text('iti_college_name',100)->nullable();
            $table->text('iti_college_location',100)->nullable();
            $table->text('iti_college_type',20)->nullable();
            $table->text('iti_board_type')->nullable();
            $table->integer('iti_trade')->nullable();
            $table->text('other_trade')->nullable();
            $table->integer('iti_passing_year')->length(11)->nullable();
            $table->text('iti_score')->nullable();

            // work experience
            $table->enum('apprentice',['YES','NO'])->default('NO');
            $table->text('apprentice_company_name')->nullable();
            $table->string('apprentice_start_date',10)->nullable();
            $table->string('apprentice_end_date',10)->nullable();
            $table->text('apprentice_location')->nullable();
            $table->text('apprentice_division')->nullable();
            $table->text('apprentice_salary')->nullable();

            $table->enum('previous_company_work',['YES','NO'])->default('NO');
            $table->text('previous_company_name')->nullable();
            $table->string('previous_company_start_date',10)->nullable();
            $table->string('previous_company_end_date',10)->nullable();
            $table->text('previous_company_location')->nullable();
            $table->text('previous_company_type')->nullable();
            $table->text('previous_company_division')->nullable();
            $table->text('previous_company_salary')->nullable();
            $table->text('previous_company_name_two')->nullable();

            $table->string('previous_company_start_date_two',10)->nullable();
            $table->string('previous_company_end_date_two',10)->nullable();
            $table->text('previous_company_location_two')->nullable();
            $table->text('previous_company_type_two')->nullable();
            $table->text('previous_company_division_two')->nullable();
            $table->text('previous_company_salary_two')->nullable();
            $table->text('previous_company_name_three')->nullable();
            $table->string('previous_company_start_date_three',10)->nullable();
            $table->string('previous_company_end_date_three',10)->nullable();
            $table->text('previous_company_location_three')->nullable();
            $table->text('previous_company_type_three')->nullable();
            $table->text('previous_company_division_three')->nullable();
            $table->text('previous_company_salary_three')->nullable();

            // other information
            $table->enum('msword',['YES','NO'])->default('NO');
            $table->enum('msexcel',['YES','NO'])->default('NO');
            $table->enum('internet',['YES','NO'])->default('NO');
            $table->enum('basic',['YES','NO'])->default('NO');
            $table->enum('nil',['YES','NO'])->default('NO');
            $table->enum('physically_handicapped',['YES','NO'])->default('NO');
            $table->text('physically_handicap_information')->nullable();
            $table->enum('car_driving',['YES','NO'])->default('NO');
            $table->text('driving_license')->nullable();
            $table->enum('epilepsy',['YES','NO'])->default('NO');
            $table->text('detail_of_past_surgery')->nullable();
            $table->text('medically_unfit')->nullable();
            $table->enum('have_you_applied',['YES','NO'])->default('NO');
            $table->text('applied_before')->nullable();
            $table->enum('already_worked',['YES','NO'])->default('NO');
            $table->text('already_worked_category')->nullable();
            $table->text('already_worked_staff_id')->nullable();
            $table->text('already_worked_time_period')->nullable();
            $table->text('already_worked_shop_location')->nullable();
            $table->enum('already_know',['YES','NO'])->default('NO');
            $table->text('already_know_full_name')->nullable();
            $table->text('already_know_department')->nullable();
            $table->text('already_know_location')->nullable();
            $table->string('already_know_mobile',13)->nullable();
            $table->text('already_know_relation')->nullable();

            // document store
            $table->text('passport_photo')->nullable();
            $table->text('tenth_certificate')->nullable();
            $table->text('twelve_certificate')->nullable();
            $table->text('iti_certificate')->nullable();
            $table->text('aadhar_card_front')->nullable();
            $table->text('aadhar_card_back')->nullable();
            $table->text('pancard')->nullable();

            $table->enum('eligibility',['Eligible','Not Eligible'])->default('eligible');
            $table->text('not_eligibility')->nullable();
            $table->enum('form_complete_status', ['Complete','Incomplete'])->default('Complete');
            $table->string('registration_date',10)->nullable();
            $table->string('next_registration_date',10)->nullable();
            $table->string('last_update_date',10)->nullable();
            $table->enum('agreed',['YES','NO'])->default('NO');
            $table->text('referred_by')->default('Shapers Consultant');
            $table->integer('form_category')->nullable();
            $table->integer('company')->nullable();
            $table->integer('exam_id')->nullable();
            $table->integer('exam_batch')->nullable();
            $table->enum('admit_card',[0,1])->default(0);
            $table->enum('exam_link_status',[0,1])->default(0);
            $table->enum('document_verify_status',[0,1])->default(0);
            $table->enum('assessment',[0,1])->default(0);
            $table->enum('interview',[0,1])->default(0);
            $table->enum('on_boarding',[0,1])->default(0);

            // foreign key
            // $table->foreign('present_state')->references('id')->on('states');
            // $table->foreign('present_district')->references('id')->on('districts');
            // $table->foreign('permanent_state')->references('id')->on('states');
            // $table->foreign('permanent_district')->references('id')->on('districts');
            // $table->foreign('iti_trade')->references('id')->on('trades');
            // $table->foreign('form_category')->references('id')->on('registration_categories');
            // $table->foreign('company')->references('id')->on('companies');
            // $table->foreign('exam_id')->references('id')->on('exams');
            // $table->foreign('exam_batch')->references('id')->on('exam_batches');
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
        Schema::dropIfExists('users');
    }
};
