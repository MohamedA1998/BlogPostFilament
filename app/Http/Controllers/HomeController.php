<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $cacheTime = Carbon::now()->addHour(2);

        $featuredPosts = Cache::remember('featuredPosts', $cacheTime, function () {
            return Post::with('categorys')->Published()->Featured()->latest('published_at')->take(3)->get();
        });

        $latestPosts = Cache::remember('latestPosts', $cacheTime, function () {
            return Post::with('categorys')->Published()->latest('published_at')->take(9)->get();
        });

        return view('home', [
            'featuredPosts' => $featuredPosts,
            'latestPosts' => $latestPosts,
        ]);
    }
}
