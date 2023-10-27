<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UKMcontroller extends Controller
{
    public function index()
    {
        return view('ukm.index');
    }
}
