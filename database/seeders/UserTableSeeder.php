<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
