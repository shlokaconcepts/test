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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('date',12)->nullable();
            $table->string('duration')->nullable();
            $table->string('center')->nullable();
            $table->string('venue')->nullable();
            $table->string('instruction')->nullable();
            $table->string('category')->nullable();
            $table->enum('status', ['0','1'])->default('1')->comment('0 = Inactive , 1 = Active');
            $table->integer('total_question')->nullable();
            $table->integer('company')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('exams');
    }
};
