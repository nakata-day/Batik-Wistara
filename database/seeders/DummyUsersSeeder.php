<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin Ternakmart',
                'email' => 'adminternakmart@gmail.com',
                'password' => bcrypt('adminternakmart'),
                'role' => 'admin',
            ],
            [
                'name' => 'Manager Ternakmart',
                'email' => 'managerternakmart@gmail.com',
                'password' => bcrypt('managerternakmart'),
                'role' => 'admin',
            ],
            [
                'name' => 'CEO Ternakmart',
                'email' => 'ceoternakmart@gmail.com',
                'password' => bcrypt('ceoternakmart'),
                'role' => 'admin',
            ],
        ];

        foreach($userData as $key => $value) {
            User::create($value);
        }
    }
}