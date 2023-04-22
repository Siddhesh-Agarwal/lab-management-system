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
                'name' => "shree",
                'email' => "admin123@gmail.com",
                'password' => bcrypt('password'),
                'role' => 'admin',
                'labname' => 'alanKay',
            ],
            [
                'name' => "varun",
                'email' => "superadmin123@gmail.com",
                'password' => bcrypt('password'),
                'role' => 'superadmin',
                'labname' => 'gimgray',
            ],

        ];

        User::insert($users);
    }
}
