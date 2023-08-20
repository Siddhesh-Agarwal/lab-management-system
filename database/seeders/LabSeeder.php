<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lab_Table;
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
            ],
            [
                'lab_name' => "Nicklaus Writh",
                'lab_code' => "NK",
            ],
            [
                'lab_name' => "John Backus",
                'lab_code' => "JB",
            ],
            [
                'lab_name' => "Djikstra",
                'lab_code' => "D",
            ],
            [
                'lab_name' => "Donald Knuth",
                'lab_code' => "DK",
                
            ],
            [
                'lab_name' => "EF Codd",
                'lab_code' => "EFC",
            ],
            [
                'lab_name' => "Jimgray",
                'lab_code' => "JG",
            ],
            [
                'lab_name' => "DSP VLSI",
                'lab_code' => "DSP/VLSI",
            ],
        ];
        
        Lab_Table::insert($labs);
    }
}
