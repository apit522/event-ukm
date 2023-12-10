<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                "post_id" => 1,
                "name" => "Belajar Golang Bareng",
                "description" => "Spesifikasi laptop minimal :\n
                1. Intel Core I9 GEN 13.\n
                2. RAM 1 TB 3200MHZ.\n
                3. Storage SSD Samsung EVO 30TB.",
                "location" => "Rawasari, Jakarta",
                "date" => "2024-12-10 14:30:00",
            ],
            [
                "post_id" => 2,
                "name" => "J-Fest Oren",
                "description" => "Peraturan saat event berlangsung :\n
                1. Harus memakai gelang tiket.\n
                2.Tidak boleh berbuat ASUSILA.\n
                3. Tidak boleh membawa makanan dari luar.\n
                4. Nikamati acara dan hyperaktif.",
                "location" => "Sigarbencah, Semarang",
                "date" => "2024-01-16 08:30:00",
            ]
        ];
        foreach ($events as $event) {
            Event::create([
                'post_id' => $event['post_id'],
                'name' => $event['name'],
                'description' => $event['description'],
                'location' => $event['location'],
                'date' => $event['date'],
            ]);
        }
    }
}
