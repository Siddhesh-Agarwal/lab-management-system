<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $student = ['rollno' => '727721EUCS140', 'labname' => "AlanKay"];
        Student::insert($student);

    }
}
