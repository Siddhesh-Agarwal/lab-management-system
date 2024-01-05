<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::table('basic_db', function (Blueprint $table) {
            DB::statement('ATTACH DATABASE "/home/sk/Documents/GitHub/lab-management-system/database/basic.sqlite" AS basic');

            // Transfer data from basic_table to target_table
            DB::statement('
            INSERT INTO students_record (name, email, regNo, degree, branch, pic)
            SELECT Name, Email, RegNo, Degree, Branch, Pic
            FROM basic.data
            ');
            DB::statement('DETACH DATABASE basic');
        });
    }

    public function down(): void
    {

    }
};
