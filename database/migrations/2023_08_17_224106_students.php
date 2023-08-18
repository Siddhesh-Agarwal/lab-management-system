<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('rollno');
            $table->string('email')->nullable();
            $table->string('degree')->nullable();
            $table->string('branch')->nullable();
            $table->string('pic')->nullable();
            $table->string('labname');
            $table->integer('systemNumber');
            $table->boolean('isLoggedIn')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};