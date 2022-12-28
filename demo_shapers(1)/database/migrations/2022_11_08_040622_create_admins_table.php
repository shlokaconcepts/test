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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('phone',50)->unique()->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('image',50)->nullable();
            $table->enum('type', [0, 1])->comment('0= Admin, 1=Super Admin')->default('0');
            $table->enum('status', [0, 1])->comment('0=Inactive, 1=active')->default('1');
            $table->string('company',20)->nullable();
            $table->string('remark')->nullable();;
            $table->string('designation')->nullable();;
            $table->string('location')->nullable();;
            $table->string('sig',50)->nullable();
            $table->string('panel',20)->nullable();
            $table->string('employee_id',50)->nullable();
            $table->enum('interviewer_type', ['hr','technical'])->nullable();
            $table->string('department',10)->nullable();
            $table->string('updated_by',30)->nullable();
            $table->string('deleted_by',30)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
};
