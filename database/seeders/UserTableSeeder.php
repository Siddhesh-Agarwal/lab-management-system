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
                'labname' => 'Gimgray',
            ],
            [
                'name' => "Master",
                'email' => "admin@gmail.com",
                'password' => bcrypt('password'),
                'role' => 'admin',
                'labname' => 'Alan Kay',
            ],
        ];

        User::insert($users);
    }
}
