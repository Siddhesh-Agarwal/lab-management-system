<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => "Shree",
                'email' => "superadmin@gmail.com",
                'password' => bcrypt('password'),
                'role' => 'superadmin',
                'labname' => 'GimGray',
            ],
        ];

        User::insert($users);
    }
}
