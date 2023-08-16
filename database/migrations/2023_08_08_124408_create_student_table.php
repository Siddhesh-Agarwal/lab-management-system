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
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('rollno');
            $table->string('name')->nullable();
            $table->string('department')->nullable();
            $table->string('year')->nullable();
            $table->string('section')->nullable();
            $table->string('labname');
            $table->boolean('isLoggedIn')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
