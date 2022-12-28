<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name');
            $table->enum('add', ['0', '1'])->nullable()->default('0');
            $table->enum('edit', ['0', '1'])->nullable()->default('0');
            $table->enum('view', ['0', '1'])->nullable()->default('1');
            $table->enum('delete', ['0', '1'])->nullable()->default('0');
            $table->enum('download', ['0', '1'])->nullable()->default('0');
            $table->enum('submit_btn', ['0', '1'])->nullable()->default('0');
            $table->enum('status', ['0', '1'])->nullable()->default('1');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
