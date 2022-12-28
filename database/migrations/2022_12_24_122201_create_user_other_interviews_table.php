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
        Schema::create('user_other_interviews', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('psychometric_test', 100)->nullable();
            $table->string('family_details', 100)->nullable();
            $table->string('general_view', 100)->nullable();
            $table->string('social_media', 100)->nullable();
            $table->string('tech_know', 20)->nullable();
            $table->string('communication', 20)->nullable();
            $table->string('rule_consciousness', 20)->nullable();
            $table->string('openness_to_change', 20)->nullable();
            $table->string('team_player', 20)->nullable();
            $table->string('enthusiasm', 20)->nullable();
            $table->string('personality', 20)->nullable();
            $table->enum('hr_status', ['Final Decision ', 'Selected', 'Rejected', 'Hold'])->default(null)->nullable();
            $table->enum('tech_status', ['Final Decision ', 'Selected', 'Rejected', 'Hold'])->default(null)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_other_interviews');
    }
};
