<?php

namespace App\Http\Middleware;

use App\Models\Traffic;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrafficVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $path = $request->path(); // Mendapatkan path URL

        // Memeriksa apakah itu URL untuk UKM atau Post
        if (strpos($path, 'ukm/') !== false) {
            $ukmId = explode('ukm/', $path)[1]; // Mendapatkan id dari URL ukm
            Traffic::create(['ukm_id' => $ukmId, 'view' => 1]);
        } elseif (strpos($path, 'post/') !== false) {
            $postId = explode('post/', $path)[1]; // Mendapatkan id dari URL post
            Traffic::create(['post_id' => $postId, 'view' => 1]);
        }

        return $next($request);
    }
}
