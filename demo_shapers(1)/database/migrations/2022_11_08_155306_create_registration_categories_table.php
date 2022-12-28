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
        Schema::create('registration_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->string('name',200);
            $table->integer('company');
            $table->enum('status',[0,1])->default(0)->comment('0=InActive 1=Active');
            $table->string('created_by');
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
        Schema::dropIfExists('registration_categories');
    }
};
