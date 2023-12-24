<?php

namespace App\Http\Controllers;

use App\Models\Traffic;
use Illuminate\Http\Request;

class TrafficController extends Controller
{
    public function shareUkm($ukmId)
    {
        // Simpan data ke database
        Traffic::create([
            'ukm_id' => $ukmId,
            'share' => 1,
        ]);

        return response()->json(['message' => 'Share recorded successfully']);
    }

    public function sharePost($postId)
    {
        // Simpan data ke database
        Traffic::create([
            'post_id' => $postId,
            'share' => 1,
        ]);

        return response()->json(['message' => 'Share recorded successfully']);
    }
}
