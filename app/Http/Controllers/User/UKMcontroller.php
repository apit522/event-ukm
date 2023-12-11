<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class UKMcontroller extends Controller
{
    public function index()
    {
        $data = Post::latest()->paginate(6);

        return view('content.index', compact('data'));
    }
}
