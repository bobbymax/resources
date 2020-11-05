<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->bigInteger('parent_id')->default(0);
            $table->enum('type', ['undefined', 'directorate', 'division', 'department', 'unit'])->default('undefined');
            $table->enum('management', ['undefined', 'deputy-manager', 'manager', 'general-manager', 'director', 'executive-secretary'])->default('undefined');
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
        Schema::dropIfExists('departments');
    }
}
