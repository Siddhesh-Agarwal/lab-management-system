<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lab__tables', function (Blueprint $table) {
            $table->id();
            $table->string('lab_name');
            $table->string('lab_code');
            $table->string('block');
            $table->string('room_number');
            $table->string('department');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        Schema::dropIfExists('lab__tables');
        DB::statement('PRAGMA foreign_keys = ON;');
    }
};
