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
        Schema::create('otherdevices', function (Blueprint $table) {
            $table->id();
            $table->integer("network_switches");
            $table->integer("ups_load");
            $table->integer("ac_load");
            $table->integer("wifi_access_points");
            $table->unsignedBigInteger('lab_id');
            $table->timestamps();
            $table->foreign('lab_id')->references('id')->on('lab__tables');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otherdevices');
    }
};
