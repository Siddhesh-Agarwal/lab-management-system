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
            // [
            //     'name' => "Shree",
            //     'email' => "727721eucs140@skcet.ac.in",
            //     'password' => bcrypt('e2018'),
            //     'role' => 'superadmin',
            //     'labname' => 'Gimgray',
            // ],
            // [
            //     'name' => "Sid",
            //     'email' => "727721eucs144@skcet.ac.in",
            //     'password' => bcrypt('Voldemort'),
            //     'role' => 'superadmin',
            //     'labname' => 'Gimgray',
            // ],
            // [
            //     'name' => "Dopes",
            //     'email' => "727721eucs134@skcet.ac.in",
            //     'password' => bcrypt('Ligand'),
            //     'role' => 'superadmin',
            //     'labname' => 'Gimgray',
            // ],
            // [
            //     'name' => "Master",
            //     'email' => "admin@gmail.com",
            //     'password' => bcrypt('password'),
            //     'role' => 'admin',
            //     'labname' => 'Alan Kay',
            // ],
            [
                'name' => "Super Admin",
                'email' => "superadmin@gmail.com",
                'password' => bcrypt('password'),
                'role' => 'superadmin',
                'labname' => 'Gimgray',
            ],
        ];

        User::insert($users);
    }
}
