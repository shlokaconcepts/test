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
        Schema::create('user_other_infos', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->text('age')->nullable();
            $table->text('birth_place')->nullable();
            $table->text('religion')->nullable();
            $table->text('mother_tongue')->nullable();
            $table->text('domicile')->nullable();
            $table->text('height')->nullable();
            $table->text('weight')->nullable();
            $table->text('marriage_date')->nullable();
            // family detail->nullable();
            $table->text('grandpa_name')->nullable();
            $table->text('grandpa_education')->nullable();
            $table->text('grandpa_age')->nullable();
            $table->text('grandpa_profession')->nullable();
            $table->text('grandpa_income')->nullable();
            $table->text('grandpa_property')->nullable();
            $table->text('grandpa_other_income')->nullable();
            $table->text('grandpa_contact_no')->nullable();
            $table->text('grandmother_name')->nullable();
            $table->text('grandmother_education')->nullable();
            $table->text('grandmother_age')->nullable();
            $table->text('grandmother_profession')->nullable();
            $table->text('grandmother_income')->nullable();
            $table->text('grandmother_property')->nullable();
            $table->text('grandmother_other_income')->nullable();
            $table->text('grandmother_contact_no')->nullable();
            $table->text('father_education')->nullable();
            $table->text('father_property')->nullable();
            $table->text('father_other_income')->nullable();
            $table->text('father_contact_no')->nullable();
            $table->text('mother_education')->nullable();
            $table->text('mother_property')->nullable();
            $table->text('mother_other_income')->nullable();
            $table->text('mother_contact_no')->nullable();
            $table->text('guardian_name')->nullable();
            $table->text('guardian_education')->nullable();
            $table->text('guardian_age')->nullable();
            $table->text('guardian_profession')->nullable();
            $table->text('guardian_income')->nullable();
            $table->text('guardian_property')->nullable();
            $table->text('guardian_other_income')->nullable();
            $table->text('guardian_contact_no')->nullable();
            $table->text('uncle1_name')->nullable();
            $table->text('uncle1_education')->nullable();
            $table->text('uncle1_age')->nullable();
            $table->text('uncle1_profession')->nullable();
            $table->text('uncle1_income')->nullable();
            $table->text('uncle1_property')->nullable();
            $table->text('uncle1_other_income')->nullable();
            $table->text('uncle1_contact_no')->nullable();
            $table->text('uncle2_name')->nullable();
            $table->text('uncle2_education')->nullable();
            $table->text('uncle2_age')->nullable();
            $table->text('uncle2_profession')->nullable();
            $table->text('uncle2_income')->nullable();
            $table->text('uncle2_property')->nullable();
            $table->text('uncle2_other_income')->nullable();
            $table->text('uncle2_contact_no')->nullable();
            $table->text('wife_education')->nullable();
            $table->text('wife_property')->nullable();
            $table->text('wife_other_income')->nullable();
            $table->text('wife_contact_no')->nullable();
            $table->text('child1_education')->nullable();
            $table->text('child1_profession')->nullable();
            $table->text('child1_income')->nullable();
            $table->text('child1_property')->nullable();
            $table->text('child1_other_income')->nullable();
            $table->text('child1_contact_no')->nullable();
            $table->text('child2_education')->nullable();
            $table->text('child2_profession')->nullable();
            $table->text('child2_income')->nullable();
            $table->text('child2_property')->nullable();
            $table->text('child2_other_income')->nullable();
            $table->text('child2_contact_no')->nullable();
            $table->text('s1_education')->nullable();
            $table->text('s1_property')->nullable();
            $table->text('s1_other_income')->nullable();
            $table->text('s1_contact_no')->nullable();
            $table->text('s2_education')->nullable();
            $table->text('s2_property')->nullable();
            $table->text('s2_other_income')->nullable();
            $table->text('s2_contact_no')->nullable();
            $table->text('mother_in_law_name')->nullable();
            $table->text('mother_in_law_education')->nullable();
            $table->text('mother_in_law_age')->nullable();
            $table->text('mother_in_law_profession')->nullable();
            $table->text('mother_in_law_income')->nullable();
            $table->text('mother_in_law_property')->nullable();
            $table->text('mother_in_law_other_income')->nullable();
            $table->text('mother_in_law_contact_no')->nullable();
            $table->text('father_in_law_name')->nullable();
            $table->text('father_in_law_education')->nullable();
            $table->text('father_in_law_age')->nullable();
            $table->text('father_in_law_profession')->nullable();
            $table->text('father_in_law_income')->nullable();
            $table->text('father_in_law_property')->nullable();
            $table->text('father_in_law_other_income')->nullable();
            $table->text('father_in_law_contact_no')->nullable();
            $table->text('brother_in_law_name')->nullable();
            $table->text('brother_in_law_education')->nullable();
            $table->text('brother_in_law_age')->nullable();
            $table->text('brother_in_law_profession')->nullable();
            $table->text('brother_in_law_income')->nullable();
            $table->text('brother_in_law_property')->nullable();
            $table->text('brother_in_law_other_income')->nullable();
            $table->text('brother_in_law_contact_no')->nullable();
            $table->text('sister_in_law_name')->nullable();
            $table->text('sister_in_law_education')->nullable();
            $table->text('sister_in_law_age')->nullable();
            $table->text('sister_in_law_profession')->nullable();
            $table->text('sister_in_law_income')->nullable();
            $table->text('sister_in_law_property')->nullable();
            $table->text('sister_in_law_other_income')->nullable();
            $table->text('sister_in_law_contact_no')->nullable();
            $table->text('fam_any_loan_lability')->nullable();
            $table->enum('relative_government_employed',['YES','NO'])->default('NO')->nullable();
            $table->text('rel_name_gov_emp')->nullable();
            $table->text('rel_relation_gov_emp')->nullable();
            $table->text('rel_buss_gov_emp')->nullable();
            // address detail->nullable();
            $table->text('permanent_post_office_tehsil')->nullable();
            $table->text('permanent_landline_mobile')->nullable();
            $table->text('permanent_stay_from')->nullable();
            $table->text('permanent_stay_two')->nullable();
            $table->text('present_post_office_tehsil')->nullable();
            $table->text('present_landline_mobile')->nullable();
            $table->text('present_stay_from')->nullable();
            $table->text('present_stay_two')->nullable();
            $table->text('year_spent_family')->nullable();
            $table->text('year_spent_relative')->nullable();
            // education detail->nullable();
            $table->text('tenth_obtain_mark')->nullable();
            $table->text('tenth_max_mark')->nullable();
            $table->text('twelve_obtain_mark')->nullable();
            $table->text('twelve_max_mark')->nullable();
            $table->enum('any_other_graduation',['YES','NO'])->default('NO')->nullable();
            $table->text('other_board')->nullable();
            $table->text('other_obtain_mark')->nullable();
            $table->text('other_max_mark')->nullable();
            $table->text('institution_name')->nullable();
            $table->text('institution_address')->nullable();
            $table->text('ot_grad_uni_na_adr')->nullable();
            $table->text('other_grad_from')->nullable();
            $table->text('other_grad_to')->nullable();
            $table->text('other_grad_passed')->nullable();
            $table->string('other_grad_program',15)->nullable();
            $table->text('other_grad_enrol_no')->nullable();
            $table->text('other_grad_deg_type')->nullable();
            $table->text('other_grad_date')->nullable();
            $table->text('other_grad_branch')->nullable();
            $table->text('iti_start_from')->nullable();
            $table->text('iti_start_to')->nullable();
            $table->text('iti_obtain_mark')->nullable();
            $table->text('iti_gap_paper')->nullable();
            $table->text('iti_attendance')->nullable();
            $table->text('iti_attendance_reason')->nullable();
            $table->text('any_diploma')->nullable();
            $table->text('diploma_college_name')->nullable();
            $table->text('diploma_start_from')->nullable();
            $table->text('diploma_start_two')->nullable();
            $table->text('diploma_trade_branch')->nullable();
            $table->text('diploma_obtain_mark')->nullable();
            $table->text('diploma_gap_paper')->nullable();
            $table->text('reas_gap_any_edu')->nullable();
            $table->text('ext_act_college')->nullable();
            $table->text('comp_know')->nullable();
            $table->enum('eng_read',['YES','NO'])->default('NO')->nullable();
            $table->enum('eng_Write',['YES','NO'])->default('NO')->nullable();
            $table->enum('eng_speak',['YES','NO'])->default('NO')->nullable();
            $table->enum('hin_read',['YES','NO'])->default('NO')->nullable();
            $table->enum('hin_Write',['YES','NO'])->default('NO')->nullable();
            $table->enum('hin_speak',['YES','NO'])->default('NO')->nullable();
            $table->enum('guj_read',['YES','NO'])->default('NO')->nullable();
            $table->enum('guj_Write',['YES','NO'])->default('NO')->nullable();
            $table->enum('guj_speak',['YES','NO'])->default('NO')->nullable();
            $table->text('other_lang')->nullable();
            $table->enum('other_read',['YES','NO'])->default('NO')->nullable();
            $table->enum('other_Write',['YES','NO'])->default('NO')->nullable();
            $table->enum('other_speak',['YES','NO'])->default('NO')->nullable();
            // work-experience detai->nullable();
            $table->text('previous_company_res_living')->nullable();
            $table->text('previous_com_cert')->nullable();
            $table->text('previous_company_res_living_two')->nullable();
            $table->text('previous_com_cert_two')->nullable();
            $table->text('previous_company_res_living_three')->nullable();
            $table->text('previous_com_cert_three')->nullable();
            // Other Informatio->nullable();
            $table->text('your_major_achievement')->nullable();
            $table->text('your_hobbies')->nullable();
            $table->text('mobile_necessary')->nullable();
            $table->text('how_many_mobile')->nullable();
            $table->text('internet_connection')->nullable();
            $table->text('mobile_uses')->nullable();
            $table->text('what_you_use_net')->nullable();
            $table->text('want_to_associate')->nullable();
            $table->text('relative_work_with_company')->nullable();
            $table->text('are_you_ready_work_in_plc')->nullable();
            $table->enum('are_you_ready_rel_anyw',['YES','NO'])->default('NO')->nullable();
            $table->enum('gov_action',['YES','NO'])->default('NO')->nullable();
            $table->text('gov_action_detail')->nullable();
            $table->enum('have_you_appeared_this_com',['YES','NO'])->default('NO')->nullable();
            $table->text('already_worked_detail')->nullable();
            $table->text('resp_per_name_one')->nullable();
            $table->text('resp_per_address_one')->nullable();
            $table->text('resp_per_cont_one')->nullable();
            $table->text('resp_per_since_know_one')->nullable();
            $table->text('resp_per_name_two')->nullable();
            $table->text('resp_per_address_two')->nullable();
            $table->text('resp_per_cont_two')->nullable();
            $table->text('resp_per_since_know_two')->nullable();
            $table->text('add_info_back_stay_from_one')->nullable();
            $table->text('add_info_back_stay_to_one')->nullable();
            $table->text('add_info_address_one')->nullable();
            $table->text('addit_info_state_one')->nullable();
            $table->text('add_info_country_one')->nullable();
            $table->text('add_info_zip_code_one')->nullable();
            $table->text('add_info_back_stay_from_two')->nullable();
            $table->text('add_info_back_stay_to_two')->nullable();
            $table->text('add_info_address_two')->nullable();
            $table->text('addit_info_state_two')->nullable();
            $table->text('add_info_country_two')->nullable();
            $table->text('add_info_zip_code_two')->nullable();
            $table->text('add_info_back_stay_from_three')->nullable();
            $table->text('add_info_back_stay_to_three')->nullable();
            $table->text('add_info_address_three')->nullable();
            $table->text('addit_info_state_three')->nullable();
            $table->text('add_info_country_three')->nullable();
            $table->text('add_info_zip_code_three')->nullable();
            $table->text('add_info_back_stay_from_four')->nullable();
            $table->text('add_info_back_stay_to_four')->nullable();
            $table->text('add_info_address_four')->nullable();
            $table->text('addit_info_state_four')->nullable();
            $table->text('add_info_country_four')->nullable();
            $table->text('add_info_zip_code_four')->nullable();
            $table->text('add_info_back_stay_from_five')->nullable();
            $table->text('add_info_back_stay_to_five')->nullable();
            $table->text('add_info_address_five')->nullable();
            $table->text('addit_info_state_five')->nullable();
            $table->text('add_info_country_five')->nullable();
            $table->text('add_info_zip_code_five')->nullable();
            $table->text('other_graduation_file')->nullable();



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
        Schema::dropIfExists('user_other_infos');
    }
};
