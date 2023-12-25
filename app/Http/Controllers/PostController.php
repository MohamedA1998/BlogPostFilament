<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        $categorys = Cache::remember('featuredPosts', Carbon::now()->addDay(), function () {
            return Category::whereHas('posts', fn ($query) => $query->Published())->take(10)->get();
        });

        return view('posts.index', [
            'categorys' => $categorys
        ]);
    }


    public function show(Post $post)
    {
        return view('posts.show', [
            'post'  => $post
        ]);
    }
}
