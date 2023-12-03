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
        Schema::create('ups_load', function (Blueprint $table) {
            $table->id();
            $table->string('ups_model');
            $table->string('ups_capacity')->nullable();
            $table->string('no_batteries')->nullable();
            $table->string('status')->nullable();
            $table->string('lab_name');
            $table->unsignedBigInteger('lab_id');
            $table->foreign('lab_id')->references('id')->on('lab__tables');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ups_load');
    }
};
