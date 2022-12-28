<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('prefix',20)->nullable();
            $table->longText('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('category',20)->nullable();
            $table->enum('question_type',[0,1])->default(0)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
