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
        Schema::create('onboardings', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->integer('venue_id')->nullable();
            $table->string('onboarding_date')->nullable();
            $table->string('remark')->nullable();
            $table->string('onboarding_by')->nullable();
            $table->enum('status', ['Pending','Absent','Joined Onboarded','Fake Document','Medical Unfit'])->nullable();
            $table->string('updated_by',50)->nullable();
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
        Schema::dropIfExists('onboardings');
    }
};
