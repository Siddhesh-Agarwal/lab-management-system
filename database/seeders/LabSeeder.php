<?php

namespace Database\Seeders;

use App\Models\Lab_Table;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labs = [
            [
                'lab_name' => "Alan Kay",
                'lab_code' => "AK",
                'block' => "CSE",
                'room_number' => "05",
                'department' => "IT",
            ],
            [
                'lab_name' => "Nicklaus Writh",
                'lab_code' => "NK",
                'block' => "CSE",
                'room_number' => "02",
                'department' => "CSE",
            ],
            [
                'lab_name' => "John Backus",
                'lab_code' => "JB",
                'block' => "CSE",
                'room_number' => "01",
                'department' => "IT",
            ],
            [
                'lab_name' => "Djikstra",
                'lab_code' => "D",
                'block' => "CSE",
                'room_number' => "06",
                'department' => "CSE",
            ],
            [
                'lab_name' => "Donald Knuth",
                'lab_code' => "DK",
                'block' => "CSE",
                'room_number' => "08",
                'department' => "CSE",
                
            ],
            [
                'lab_name' => "EF Codd",
                'lab_code' => "EFC",
                'block' => "CSE",
                'room_number' => "07",
                'department' => "IT",
            ],
            [
                'lab_name' => "Jimgray",
                'lab_code' => "JG",
                'block' => "CSE",
                'room_number' => "09",
                'department' => "IT",
            ],
            [
                'lab_name' => "DSP VLSI",
                'lab_code' => "DSP/VLSI",
                'block' => "CSE",
                'room_number' => "11",
                'department' => "IT",
            ],
        ];
        Lab_Table::insert($labs);
    }
}
