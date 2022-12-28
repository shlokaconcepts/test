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
        Schema::create('registration_links', function (Blueprint $table) {
            $table->id();
            $table->string('company',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('full_url')->nullable();
            $table->string('closed_time',50)->nullable();
            $table->longText('description')->nullable();
            $table->enum('status', ['0', '1'])->comment('0=Inactive, 1=active')->default('1');
            $table->string('form_category',10);
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
        Schema::dropIfExists('registration_links');
    }
};
