<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Post;
use App\Models\UKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UKMcontroller extends Controller
{

    public function index()
    {
        $data = Post::latest()->paginate(6);

        $latestPosts = Post::whereHas('event')
            ->with('event') // Menyertakan data dari relasi event
            ->latest()
            ->take(1)
            ->get();

        return view('content.index', compact('data', 'latestPosts'));
    }

    public function profile($id)
    {
        $ukm = UKM::find($id);
        $posts = $ukm->post()->get();

        return view('content.profile', compact('ukm', 'posts'));
    }

    public function showLoginForm()
    {
        return view('form.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (auth('ukm')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended('/');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request)
    {
        auth('ukm')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
    public function dashboard()
    {
        $ukm = auth('ukm')->user();
        $postsData = $ukm->posts_data;
        $trafficData = $postsData->pluck('traffic_count');
        $postNames = $postsData->pluck('post_name');
        $sharesData = $postsData->pluck('shares_count');
        $totalTraffic = $trafficData->sum();
        $totalShares = $sharesData->sum();

        return view('ukm-dashboard.dashboard', compact('trafficData', 'postNames', 'sharesData', 'totalTraffic', 'totalShares'));
    }
    public function post()
    {
        $data = auth('ukm')->user()->post;
        return view('ukm-dashboard.post', compact('data'));
    }
    public function dashboardProfile()
    {

        return view('ukm-dashboard.profile');
    }
}
