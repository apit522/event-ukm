<?php

namespace Database\Seeders;

use App\Models\UKM;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UKMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ukm = [
            [
                "name" => "Polytechnic Computer Club",
                "email" => 'pcc@polines.com',
                "password" => "admin12345",
                "profile_picture" => "https://www.ukmpcc.org/assets/Logo%20PCC.png"
            ],
        ];
        foreach ($ukm as $vendor) {
            UKM::create([
                'name' => $vendor['name'],
                'email' => $vendor['email'],
                'password' => bcrypt($vendor['password']),
                'profile_picture' => $vendor['profile_picture']
            ]);
        }
    }
}
