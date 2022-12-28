<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('user_document_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->enum('profile_image', ['UnVerified','Approve','Reject'])->default('UnVerified');
            $table->enum('tenth_certificate', ['UnVerified','Approve','Reject'])->default('UnVerified');
            $table->enum('twelve_certificate', ['UnVerified','Approve','Reject'])->default('UnVerified');
            $table->enum('iti_certificate', ['UnVerified','Approve','Reject'])->default('UnVerified');
            $table->enum('aadhar_card_front', ['UnVerified','Approve','Reject'])->default('UnVerified');
            $table->enum('aadhar_card_back', ['UnVerified','Approve','Reject'])->default('UnVerified');
            $table->enum('pan_card', ['UnVerified','Approve','Reject'])->default('UnVerified');
            $table->string('remark')->nullable();
            $table->string('verify_date',10)->nullable();
            $table->string('verified_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->enum('status', ['Pending','Absent','Hold','Doc Ok','Doc Mismatch','Fake Document','Document Not Available','Rejected'])
            ->comment('Doc Ok : All documents available and no mismatch in any document i.e name/DOB/Father name,
                 Doc Mismatch : All documents available but name/DOB/Father name mismatched,
                 Hold : ITI handwritten.,
                 Fake Documents: Any fake document uploaded by candidate.,
                 Document missing: In case of any document not uploaded by candidate.,
                 Rejected : Trade not valid / Over Age.')
            ->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_document_statuses');
    }
};
