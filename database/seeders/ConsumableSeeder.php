<?php

namespace Database\Seeders;

use App\Models\Consumable;
use Illuminate\Database\Seeder;

class ConsumableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consumable = [
            [
                'labname' => "Alan Kay",
                'count' => 6,
                'serial_number' => 'SNJAIIOIW54RQ',
                'device_name' => 'mouse'
            ],
        ];

        Consumable::insert($consumable);

    }
}
