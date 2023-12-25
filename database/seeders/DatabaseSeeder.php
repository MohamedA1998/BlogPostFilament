<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if ($this->command->ask('Do You Wont To Resfesh Database', 'yes')) {
            $this->command->call('migrate:refresh');
        }

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role'  => User::ROLE_ADMIN
        ]);

        $users = User::factory(25)->create();

        $posts = Post::factory()->count(100)->make()->each(function ($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });

        Comment::factory(1000)->make()->each(function ($comment) use ($users, $posts) {
            $comment->user_id = $users->random()->id;
            $comment->post_id = $posts->random()->id;
            $comment->save();
        });

        $Categorys = Category::factory(5)->create();

        for ($i = 0; $i < count($posts); $i++) {
            DB::table('category_post')->insert([
                'category_id' => $Categorys->random()->id,
                'post_id' => $posts->random()->id,
            ]);
        }

        for ($i = 0; $i < 1000; $i++) {
            DB::table('user_like_post')->insert([
                'user_id' => $users->random()->id,
                'post_id' => $posts->random()->id,
            ]);
        }
    }
}
