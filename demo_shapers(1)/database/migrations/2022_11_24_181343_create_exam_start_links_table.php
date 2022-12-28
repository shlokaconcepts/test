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
        Schema::create('exam_start_links', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->integer('exam_id');
            $table->integer('company');
            $table->string('full_url');
            $table->string('access_token');
            $table->string('exam_date',10);
            $table->string('user_logged_in_device')->nullable();
            $table->string('user_logged_ip')->nullable();
            $table->enum('logged_in_status',[0,1])->default(0);
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
        Schema::dropIfExists('exam_start_links');
    }
};
