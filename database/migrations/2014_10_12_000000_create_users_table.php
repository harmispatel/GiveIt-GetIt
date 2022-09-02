<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('user_type');
            $table->string('password');
            $table->boolean('status');
            $table->string('token')->after('status')->nullable(); 
            $table->string('email_token')->after('token')->nullable()->change();
            // $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
