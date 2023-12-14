<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;

class UKMcontroller extends Controller
{
    public function index()
    {
        $data = Post::latest()->paginate(6);

        $latestPosts = Post::whereHas('event')
            ->with('event') // Menyertakan data dari relasi event
            ->latest()
            ->take(3)
            ->get();

        return view('content.index', compact('data', 'latestPosts'));
    }
}
