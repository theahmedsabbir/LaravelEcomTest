<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('type')->default('super_admin')->comment('admin|super_admin');
            // ## will have to create this, right now causing problem
            // $table->string('remember_token')
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
