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
        Schema::create('network_switches', function (Blueprint $table) {
            $table->id();
            $table->string('switch_model');
            $table->string('serial_number')->nullable();
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
        Schema::dropIfExists('network_switches');
    }
};
