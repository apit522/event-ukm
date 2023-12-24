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
                'username' => "pccpolines",
                "email" => 'pcc@polines.com',
                "password" => "admin12345",
                "profile_picture" => "https://www.ukmpcc.org/assets/Logo%20PCC.png",
                "description" => "𝙋𝘾𝘾 - 𝙎𝙃𝘼𝙍𝙀 𝙔𝙊𝙐𝙍 𝙆𝙉𝙊𝙒𝙇𝙀𝘿𝙂𝙀!!!",
                "instagram" => "https://www.instagram.com/pccpolines/",
                "facebook" => "https://www.facebook.com/ukmpcc",
                "twitter" => "https://twitter.com/ukmpcc",
                "youtube" => "https://www.youtube.com/@UKMPCCPOLINES"

            ],
            [
                "name" => "Komunitas Seni Polines",
                'username' => "konseppolines",
                "email" => 'seni@polines.com',
                "password" => "admin12345",
                "profile_picture" => "https://web.polines.ac.id/wp-content/uploads/2021/12/komunitas-seni-polines.png",
                "description" => "Seni Musik, Tari, Paduan Suara, Teater, Rupa #WeAreAHappyFamily",
                "instagram" => "https://www.instagram.com/komunitassenipolines/",
                "facebook" => null,
                "twitter" => "https://twitter.com/konsepfamily",
                "youtube" => "https://www.youtube.com/@konsepcommunity9219"
            ],
            [
                "name" => "UKM Pengembangan Pengetahuan",
                "email" => 'pp@polines.com',
                'username' => "ukmpp",
                "password" => "admin12345",
                "profile_picture" => "https://www.ukmpp.org/wp-content/uploads/2021/07/LOGO-PP-HD-1024x1024.png",
                "description" => "Science without Religion is Blind, Religion without Science is Lame.",
                "instagram" => "https://www.instagram.com/ukmpp_polines/",
                "facebook" => null,
                "twitter" => "https://twitter.com/ukmpp",
                "youtube" => "https://www.youtube.com/@ukmpengembanganpengetahuan8452"
            ],


        ];
        foreach ($ukm as $vendor) {
            UKM::create([
                'name' => $vendor['name'],
                'username' => $vendor['username'],
                'email' => $vendor['email'],
                'password' => bcrypt($vendor['password']),
                'profile_picture' => $vendor['profile_picture'],
                'description' => $vendor['description'],
                'instagram' => $vendor['instagram'],
                'facebook' => $vendor['facebook'],
                'twitter' => $vendor['twitter'],
                'youtube' => $vendor['youtube'],
            ]);
        }
    }
}
