<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            [
                "email" => 'admin@admin.com',
                "password" => "admin12345",
            ],
        ];
        foreach ($admin as $vendor) {
            Admin::create([
                'email' => $vendor['email'],
                'password' => bcrypt($vendor['password'])
            ]);
        }
    }
}
