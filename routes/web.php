<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RegistrationLinkController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\RegistrationCategoryController;
use App\Http\Controllers\GetterController;
use App\Http\Controllers\ExamQuestionController;
use App\Http\Controllers\ExamBatchController;
use App\Http\Controllers\ExamStartLinkController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationFormController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

Auth::routes();
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Session::flush();
    return "Cleared!";
});





// getter 
Route::get('fetch-districts/{id}', [GetterController::class, 'getDistricts']);
// home page
Route::get('/', [LandingPageController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('privacy-policy', [LandingPageController::class, 'privacy_policy']);
Route::get('terms-&-condition', [LandingPageController::class, 'terms_condition']);


// login module
Route::get('admin/login', [LoginController::class, 'adminLoginForm'])->name('admin.login');
Route::post('admin_login', [LoginController::class, 'adminLogin'])->name('admin_login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    // edit profile 
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('change-profile', [AdminController::class, 'change_profile'])->name('admin.change-profile');
    Route::post('change-password', [AdminController::class, 'change_password'])->name('admin.change-password');

    // export to excel 
    Route::get('export_to_excel_registrations/{data}', [ExportController::class, 'exportRegistrations']);
    Route::post('export_to_excel_candidate_status', [ExportController::class, 'exportCandidateStatus']);
    Route::post('export_to_excel_eligible_candidate', [ExportController::class, 'exportEligibleCandidate']);
    Route::post('export_to_excel_ready_for_assessment', [ExportController::class, 'exportReadyAssessment']);
    Route::post('export_to_excel_check_candidate', [ExportController::class, 'exportCheckCandidate']);
    Route::post('export_to_excel_interviewer', [ExportController::class, 'exportInterviewer']);



    // getter controller
    Route::get('get_rg_category/{id}', [GetterController::class, 'getRegistrationCategory']);
    Route::get('print-caf-form/{id}', [GetterController::class, 'print_caf_form'])->name('admin.print-caf-form');
    Route::get('print-assessment-report/{id}', [GetterController::class, 'printAssessmentReport'])->name('admin.print-assessment-report');
    Route::get('print-interview-report/{id}', [GetterController::class, 'printInterviewReport'])->name('admin.print-interview-report');
    Route::get('candidate-detail/{id}', [UserController::class, 'viewCandidateDetail'])->name('admin.candidate-detail');
    Route::post('update-candidate-detail', [RegistrationFormController::class, 'update_candidate_detail'])->name('admin.update-candidate-detail');
    Route::get('fetch-exam-batch/{id}', [GetterController::class, 'fetch_exam_batch'])->name('admin.fetch-exam-batch');
    Route::get('admit-card/{id}', [UserController::class, 'viewAdmitCard'])->name('admin.admit-card');
    Route::get('document-verification/{id}', [UserController::class, 'viewDocVerification'])->name('admin.document-verification');
    Route::post('change-document-status', [AdminController::class, 'change_document_status'])->name('admin.change-document-status');
    Route::post('mark-to-absent-document', [AdminController::class, 'docAbsent'])->name('admin.mark-to-absent-document');
    Route::post('candidate-assign-exam', [AdminController::class, 'candidate_assign_exam'])->name('admin.candidate-assign-exam');
    Route::post('send-exam-link', [ExamStartLinkController::class, 'send_exam_link'])->name('admin.send-exam-link');
    Route::post('mark-as-eligible', [AdminController::class, 'mark_as_eligible'])->name('admin.mark-as-eligible');
    Route::post('get-candidate-exam-link-qr-code', [UserController::class, 'getExamLinkQr'])->name('admin.get-candidate-exam-link-qr-code');
    Route::get('candidate-interview-ass-sheet/{id}', [UserController::class, 'candidate_interview_result_detail'])->name('admin.candidate-interview-ass-sheet');
    Route::get('candidate-onboard-now/{id}', [UserController::class, 'candidate_onboard_now'])->name('admin.candidate-onboard-now');

    Route::post('admin_logout', [LoginController::class, 'logout'])->name('admin_logout');
    Route::get('dashboard', [AdminController::class, 'dashboard']);

    // crud Menu
    Route::get('menu-list', [MenuController::class, 'index'])->name('admin.menu-list');
    Route::post('add-menu', [MenuController::class, 'create'])->name('admin.add-menu');
    Route::POST('edit-menu', [MenuController::class, 'update'])->name('admin.edit-menu');
    Route::delete('delete-menu', [MenuController::class, 'destroy'])->name('admin.delete-menu');
    //end crud Menu

    // Department crud
    Route::get('departments-list', [DepartmentController::class, 'index'])->name('admin.departments-list');
    Route::get('add-department', [DepartmentController::class, 'create'])->name('admin.add-department');
    Route::post('add-department', [DepartmentController::class, 'store'])->name('admin.add-department');
    Route::get('edit-department/{id}', [DepartmentController::class, 'show'])->name('admin.edit-department');
    Route::post('post-edit-department', [DepartmentController::class, 'update'])->name('admin.post-edit-department');
    Route::delete('delete-department', [DepartmentController::class, 'destroy'])->name('admin.delete-department');
    //end Department crud


    // crud company
    Route::get('company-list', [CompanyController::class, 'index'])->name('admin.company-list');
    Route::get('create-company', [CompanyController::class, 'create'])->name('admin.create-company');

    Route::post('add-Company', [CompanyController::class, 'store'])->name('admin.add-Company');
    Route::post('edit-company', [CompanyController::class, 'update'])->name('admin.edit-company');
    Route::delete('delete-company', [CompanyController::class, 'destroy'])->name('admin.delete-company');
    //end crud company

    // crud Admin
    Route::get('employee-list', [AdminController::class, 'index'])->name('admin.employee-list');
    Route::post('add-employee', [AdminController::class, 'store'])->name('admin.add-employee');
    Route::post('edit-employee', [AdminController::class, 'update'])->name('admin.edit-employee');
    Route::delete('delete-employee', [AdminController::class, 'destroy'])->name('admin.delete-employee');
    //end crud Admin

    // crud Registration Link
    Route::get('link-list', [RegistrationLinkController::class, 'index'])->name('admin.link-list');
    Route::post('add-link', [RegistrationLinkController::class, 'store'])->name('admin.add-link');
    Route::post('edit-link', [RegistrationLinkController::class, 'update'])->name('admin.edit-link');
    Route::post('registration-link-change-status', [RegistrationLinkController::class, 'update_status'])->name('admin.registration-link-change-status');
    Route::delete('delete-link', [RegistrationLinkController::class, 'destroy'])->name('admin.delete-link');
    //end Registration Link



    // crud Exam
    Route::get('exam-list', [ExamController::class, 'index'])->name('admin.exam-list');
    Route::post('add-exam', [ExamController::class, 'store'])->name('admin.add-exam');
    Route::post('edit-exam', [ExamController::class, 'update'])->name('admin.edit-exam');
    Route::post('exam-change-status', [ExamController::class, 'update_status'])->name('admin.exam-change-status');
    Route::delete('delete-exam', [ExamController::class, 'destroy'])->name('admin.delete-exam');
    Route::get('get-exam-detail/{id}', [ExamController::class, 'edit'])->name('admin.get-exam-detail');
    //end exam


    // crud Trade
    Route::get('trade-list', [TradeController::class, 'index'])->name('admin.trade-list');
    Route::post('add-trade', [TradeController::class, 'store'])->name('admin.add-trade');
    Route::post('edit-trade', [TradeController::class, 'update'])->name('admin.edit-trade');
    Route::post('trade-change-status', [TradeController::class, 'update_status'])->name('admin.trade-change-status');
    Route::delete('delete-trade', [TradeController::class, 'destroy'])->name('admin.delete-trade');
    //end Trade

    // crud Registration Category
    Route::get('rg-category-list', [RegistrationCategoryController::class, 'index'])->name('admin.rg-category-list');
    Route::post('add-rg-category', [RegistrationCategoryController::class, 'store'])->name('admin.add-rg-category');
    Route::post('edit-rg-category', [RegistrationCategoryController::class, 'update'])->name('admin.edit-rg-category');
    Route::post('rg-category-change-status', [RegistrationCategoryController::class, 'update_status'])->name('admin.rg-category-change-status');
    Route::delete('delete-rg-category', [RegistrationCategoryController::class, 'destroy'])->name('admin.delete-rg-category');
    //end Trade

    // crud exam question
    Route::get('exam-question-list', [ExamQuestionController::class, 'index'])->name('admin.exam-question-list');
    Route::post('add-exam-question', [ExamQuestionController::class, 'store'])->name('admin.add-exam-question');
    Route::post('edit-exam-question', [ExamQuestionController::class, 'update'])->name('admin.edit-exam-question');
    Route::post('exam-question-change-status', [ExamQuestionController::class, 'update_status'])->name('admin.exam-question-change-status');
    Route::delete('delete-exam-question', [ExamQuestionController::class, 'destroy'])->name('admin.delete-exam-question');
    //end exam question

    // crud exam batch
    Route::get('exam-batch-list', [ExamBatchController::class, 'index'])->name('admin.exam-batch-list');
    Route::post('add-exam-batch', [ExamBatchController::class, 'store'])->name('admin.add-exam-batch');
    Route::post('edit-exam-batch', [ExamBatchController::class, 'update'])->name('admin.edit-exam-batch');
    Route::post('exam-batch-change-status', [ExamBatchController::class, 'update_status'])->name('admin.exam-batch-change-status');
    Route::delete('delete-exam-batch', [ExamBatchController::class, 'destroy'])->name('admin.delete-exam-batch');
    Route::post('get-exam-duration', [ExamBatchController::class, 'get_exam_duration'])->name('admin.get-exam-duration');
    //end exam batch


    // site setting
    Route::get('site-setting', [SettingController::class, 'index'])->name('admin.site-setting');
    Route::post('edit-site-setting', [SettingController::class, 'update'])->name('admin.edit-site-setting');


    // Eligible Candidates
    Route::get('registration-list', [AdminController::class, 'registration_list'])->name('admin.registration-list');
    Route::get('candidate-tracking-system', [AdminController::class, 'trackingSystem'])->name('admin.candidate-tracking-system');
    Route::get('eligible-candidates-list', [AdminController::class, 'eligible_candidate'])->name('admin.eligible-candidates-list');
    Route::get('ready-for-assessment', [AdminController::class, 'ready_for_assessment'])->name('admin.ready-for-assessment');
    Route::get('candidate-document/{status}', [AdminController::class, 'candidate_document_status_list']);
    Route::get('absent-candidate', [AdminController::class, 'absent_candidate'])->name('admin.absent-candidate');


    // assessment module 
    Route::get('pending-assessment', [AdminController::class, 'pending_assessment_list'])->name('admin.pending-assessment');
    Route::post('submit-exam-manually', [AdminController::class, 'submit_exam_manually'])->name('admin.submit-exam-manually');
    Route::get('assessment-result', [AdminController::class, 'assessment_list'])->name('admin.assessment-result');
    Route::get('fetch-assessment-details/{id}', [UserController::class, 'fetch_assessment_details'])->name('admin.fetch-assessment-details');
    Route::post('update-assessment-mark', [AdminController::class, 'update_passing_mark'])->name('admin.update-assessment-mark');
    Route::post('mark_absent_for_interview', [AdminController::class, 'mark_absent_for_interview'])->name('admin.mark_absent_for_interview');
    Route::get('check-candidate', [AdminController::class, 'check_candidate'])->name('admin.check-candidate');
    // end assessment module


    // interviewer module
    Route::get('interviewer-list', [AdminController::class, 'interviewer_list'])->name('admin.interviewer-list');
    Route::post('interviewer-change-status', [AdminController::class, 'interviewer_status_change'])->name('admin.interviewer-change-status');
    Route::post('add-new-interviewer', [AdminController::class, 'storeInterviewer'])->name('admin.add-new-interviewer');
    Route::get('get-interviewer-detail/{id}', [AdminController::class, 'get_interviewer_detail'])->name('admin.get-interviewer-detail');
    Route::post('delete-interviewer', [AdminController::class, 'delete_interviewer_detail'])->name('admin.delete-interviewer');
    Route::get('initiate-interview', [AdminController::class, 'initiate_interview'])->name('admin.initiate-interview');
    Route::get('take-interview/{id}', [AdminController::class, 'take_interview'])->name('admin.take-interview');
    Route::post('store-interview-detail', [AdminController::class, 'store_interview_detail'])->name('admin.store-interview-detail');
    Route::get('interview-result', [AdminController::class, 'candidate_interview_result'])->name('admin.interview-result');
    // end interviewer module

    // onboarding venue module
    Route::get('onboarding-venue-list', [AdminController::class, 'onboarding_venue_list'])->name('admin.onboarding-venue-list');
    Route::post('operation-onboarding-venue', [AdminController::class, 'operation_onboarding_venue'])->name('admin.operation-onboarding-venue');
    Route::get('onboarding-venue-change-status/{id}', [AdminController::class, 'onboarding_venue_status_change'])->name('admin.onboarding-venue-change-status');
    Route::delete('delete-onboarding-venue/{id}', [AdminController::class, 'delete_onboarding_venue']);



    // onboarding candidates 
    Route::get('boarding-unapproved-candidates', [AdminController::class, 'onboarding_unapproved_candidate'])->name('admin.boarding-unapproved-candidates');
    Route::get('boarding-approved-candidates', [AdminController::class, 'onboarding_approved_candidate'])->name('admin.boarding-approved-candidates');
    Route::post('boarding-approved-candidates', [AdminController::class, 'onboarding_approved_candidate'])->name('admin.boarding-approved-candidates');
    Route::post('onboard_now', [AdminController::class, 'onboard_now'])->name('admin.onboard_now');
});



// registration precess 
Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('register-with-my-email/{company}/{category}', [RegistrationFormController::class, 'register_with_my_email']);
    Route::post('send-otp', [RegistrationFormController::class, 'send_otp'])->name('send-otp');
    Route::get('resend-otp', [RegistrationFormController::class, 'resend_otp']);
    Route::post('verify-code', [RegistrationFormController::class, 'verify_code'])->name('verify-code');

    Route::get('my-form', [RegistrationFormController::class, 'registration_form']);
    //  for smg routes
    Route::post('store-personal-detail', [RegistrationFormController::class, 'store_personal_detail'])->name('store-personal-detail');
    Route::post('store-address-detail', [RegistrationFormController::class, 'store_address_detail'])->name('store-address-detail');
    Route::post('store-education-detail', [RegistrationFormController::class, 'store_education_detail'])->name('store-education-detail');
    Route::post('store-work-experience-detail', [RegistrationFormController::class, 'store_work_experience_detail'])->name('store-work-experience-detail');
    Route::post('store-other-info-detail', [RegistrationFormController::class, 'store_other_info_detail'])->name('store-other-info-detail');
    Route::post('store-document-detail', [RegistrationFormController::class, 'store_document_detail'])->name('store-document-detail');
    Route::post('store-family-detail', [RegistrationFormController::class, 'store_family_detail'])->name('store-family-detail');
    Route::get('confirm-form', [RegistrationFormController::class, 'confirm_page']);
    Route::post('update-eligibility', [RegistrationFormController::class, 'update_eligibility'])->name('update-eligibility');
    Route::post('store-user-details', [RegistrationFormController::class, 'store_user_details'])->name('store-user-details');

    Route::get('candidate-exam', [UserController::class, 'examLogin']);
    Route::post('post-candidate-exam-login', [ExamController::class, 'candidateLogin'])->name('post-candidate-exam-login');
    Route::get('assessment', [ExamController::class, 'assessment'])->name('assessment');
    Route::post('submit-question-answer', [ExamController::class, 'submit_question_answer'])->name('submit-question-answer');
    Route::post('submit_exam', [ExamController::class, 'post_submit_exam'])->name('submit_exam');
    Route::get('assessment-submitted', [ExamController::class, 'assessment_submitted'])->name('assessment-submitted');
});
