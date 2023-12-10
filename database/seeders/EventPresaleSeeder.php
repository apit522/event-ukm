<?php

namespace Database\Seeders;

use App\Models\EventPresale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventPresaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                "event_price_id" => 1,
                "variant" => "Presale 1",
                "discount" => 40,
                "start_date" => "2023-12-10 14:30:00",
                "due_to" => "2024-01-01 14:30:00",
                "max_purchase" => "200",
            ],
            [
                "event_price_id" => 2,
                "variant" => "Presale 1",
                "discount" => 40,
                "start_date" => "2023-12-10 14:30:00",
                "due_to" => "2024-01-01 14:30:00",
                "max_purchase" => "400"
            ],
            [
                "event_price_id" => 1,
                "variant" => "Presale 2",
                "discount" => 30,
                "start_date" => "2024-12-10 14:30:00",
                "due_to" => "2024-01-01 14:30:00",
                "max_purchase" => "300",
            ],
            [
                "event_price_id" => 2,
                "variant" => "Presale 2",
                "discount" => 30,
                "start_date" => "2024-12-10 14:30:00",
                "due_to" => "2024-01-01 14:30:00",
                "max_purchase" => "500",
            ],
            [
                "event_price_id" => 1,
                "variant" => "Sale",
                "discount" => 0,
                "start_date" => "2024-12-01 14:30:00",
                "due_to" => "2024-12-10 14:30:00",
                "max_purchase" => null
            ],
            [
                "event_price_id" => 2,
                "variant" => "Sale",
                "discount" => 0,
                "start_date" => "2024-12-01 14:30:00",
                "due_to" => "2024-12-10 14:30:00",
                "max_purchase" => null
            ],
            [
                "event_price_id" => 3,
                "variant" => "Sale",
                "discount" => 0,
                "start_date" => "2023-12-10 14:30:00",
                "due_to" => "2024-01-16 14:30:00",
                "max_purchase" => null
            ],
        ];
        foreach ($events as $event) {
            EventPresale::create([
                'event_price_id' => $event['event_price_id'],
                'variant' => $event['variant'],
                'discount' => $event['discount'],
                'start_date' => $event['start_date'],
                'due_to' => $event['due_to'],
                'max_purchase' => $event['max_purchase'],
            ]);
        }
    }
}
