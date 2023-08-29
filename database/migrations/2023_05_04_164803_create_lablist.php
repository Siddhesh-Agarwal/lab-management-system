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
        Schema::create('lablists', function (Blueprint $table) {
            $table->id();
            $table->string('device_name');
            $table->string('spec');
            $table->string('system_number')->unique();
            $table->string('type');
            $table->string('desc')->nullable();
            $table->unsignedBigInteger('lab_id');
            $table->string('lab_name');
            $table->foreign('lab_id')->references('id')->on('lab__tables');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lablists');
    }
};
