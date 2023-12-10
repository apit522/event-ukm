<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\EventPresale;
use App\Models\EventPrice;
use App\Models\PostPhoto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UKMSeeder::class,
            PostSeeder::class,
            PostPhotoSeeder::class,
            EventSeeder::class,
            EventPriceSeeder::class,
            EventPresaleSeeder::class

        ]);
    }
}
