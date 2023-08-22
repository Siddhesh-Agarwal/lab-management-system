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
        Schema::create('log_details', function(Blueprint $table) {
            $table->id();
            $table->string('rollno');
            $table->string('labname');
            $table->integer('random')->default(0);
            $table->string('system_number')->nullable();
            $table->date('logout_time');
            $table->date('login_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            Schema::dropIfExists('log_details');
    }
};
