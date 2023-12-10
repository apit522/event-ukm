<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                "ukm_id" => 1,
                "judul" => "Golang 2024",
                "description" => "Golang saat ini sangat digemari oleh perusahaan startup untuk bagian Backend, maka dari itu developer disarankan untuk belajar bahasa pemrograman dari Google ini. Kami akan mengadakan belajar Golang bersama yang bisa kalian ikuti.",
            ],
            [
                "ukm_id" => 2,
                "judul" => "We Fest",
                "description" => "Ayo ikuti event terbesar tahun ini jangan sampai kelewatan. Kapan lagi yaa kan.",
            ],
            [
                "ukm_id" => 3,
                "judul" => "Kegiatan Sosialisasi di Boyolali",
                "description" => "Minggu kemarin, kami tim IT melakukan sosialisasi di Desa Pengkol, Boyolali terkait pentingnya menghemat listrik dan cara berhematnya.",
            ],
        ];
        foreach ($posts as $post) {
            Post::create([
                'ukm_id' => $post['ukm_id'],
                'judul' => $post['judul'],
                'description' => $post['description'],
            ]);
        }
    }
}
