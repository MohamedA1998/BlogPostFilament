<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLikePostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();
        $comments = Comment::all();

        $posts->each(function ($post) use ($users) {
            $random = rand(1, 5);
            for ($i = 0; $i <= $random; $i++) {
                $post->likes()->attach($users->random()->id);
            }
        });

        $comments->each(function ($comment) use ($users) {
            $random = rand(1, 5);
            for ($i = 0; $i <= $random; $i++) {
                $comment->likes()->attach($users->random()->id);
            }
        });
    }
}
