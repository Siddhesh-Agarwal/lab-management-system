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
                'lab_name' => "Alan Kay"
            ],
            [
                'lab_name' => "Nicklaus Writh"
            ],
            [
                'lab_name' => "John Backus"
            ],
            [
                'lab_name' => "Djikstra"
            ],
            [
                'lab_name' => "Donald Knuth"
            ],
            [
                'lab_name' => "EF Codd"
            ],
            [
                'lab_name' => "Jimgray"
            ],
            [
                'lab_name' => "DSP VLSI"
            ],
        ];
        
        Lab_Table::insert($labs);
    }
}
