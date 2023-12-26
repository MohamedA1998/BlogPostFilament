<?php

namespace Database\Seeders;

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

        for ($i = 0; $i < 1000; $i++) {
            DB::table('user_like_post')->insert([
                'user_id' => $users->random()->id,
                'post_id' => $posts->random()->id,
            ]);
        }
    }
}
