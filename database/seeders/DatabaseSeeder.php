<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "User",
                "email" => "user@gmail.com",
                "password" => Hash::make('user123'),
                "is_admin" => false
            ],
            [
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make('admin123'),
                "is_admin" => true
            ]
        ];

        foreach ($users as $user) {
            User::insert($user);
        }
    }
}
