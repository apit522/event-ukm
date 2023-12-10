<?php

namespace Database\Seeders;

use App\Models\EventPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                "event_id" => 1,
                "variant" => "VIP",
                "price" => 150000,
                "max_visitor" => 1500,
            ],
            [
                "event_id" => 1,
                "variant" => "Reguler",
                "price" => 50000,
                "max_visitor" => 3000,
            ],
            [
                "event_id" => 2,
                "variant" => "Nakama",
                "price" => 45000,
                "max_visitor" => 100000,
            ],
        ];
        foreach ($events as $event) {
            EventPrice::create([
                'event_id' => $event['event_id'],
                'variant' => $event['variant'],
                'price' => $event['price'],
                'max_visitor' => $event['max_visitor'],
            ]);
        }
    }
}
