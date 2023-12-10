<?php

namespace Database\Seeders;

use App\Models\PostPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                "post_id" => 1,
                "file" => "https://pbs.twimg.com/media/E3_rJZvWUAQLWYy.jpg:large",
                "cover" => 1,
            ],
            [
                "post_id" => 2,
                "file" => "https://eventkampus.com/data/event/0/610/poster-orenji-2017.jpg",
                "cover" => 1,
            ],
            [
                "post_id" => 2,
                "file" => "https://www.nusabali.com/images/event/poster_jfeststikombali2019.jpg",
                "cover" => 0,
            ],
            [
                "post_id" => 3,
                "file" => "https://i.ibb.co/DtKpSKX/Hemat-Energi-Listrik.png",
                "cover" => 1,
            ],
            [
                "post_id" => 3,
                "file" => "https://cdn.antarafoto.com/cache/1200x723/2009/12/14/sosialisasi-hemat-listrik-1ulf-dom.jpg",
                "cover" => 0,
            ],
            [
                "post_id" => 3,
                "file" => "https://probolinggokab.go.id/wp-content/uploads/2019/11/Pemkab-Sosialisasikan-Hemat-Energi.jpg",
                "cover" => 0,
            ],
        ];
        foreach ($posts as $post) {
            PostPhoto::create([
                'post_id' => $post['post_id'],
                'file' => $post['file'],
                'cover' => $post['cover'],
            ]);
        }
    }
}
