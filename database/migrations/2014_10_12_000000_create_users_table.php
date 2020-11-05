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
            $table->string('staff_no')->unique();
            $table->string('firstname');
            $table->string('surname');
            $table->string('middlename')->nullable();
            $table->string('email')->unique();
            $table->string('mobile')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->bigInteger('grade_id')->default(0);
            $table->bigInteger('location_id')->deafult(0);
            $table->string('avatar')->nullable();

            $table->date('date_joined')->nullable();
            $table->enum('type', ['undefined', 'permanent', 'secondment', 'contract', 'adhoc'])->default('undefined');
            $table->enum('status', ['available', 'training', 'leave', 'assignment', 'retired', 'abscent'])->default('available');
            $table->string('password');

            $table->boolean('isAdministrator')->default(false);
            $table->boolean('authorised')->default(true);
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
        Schema::dropIfExists('users');
    }
}
