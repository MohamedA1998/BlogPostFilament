<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();

        $users = User::all();

        if ($posts->count() === 0 || $users->count() === 0) {
            $this->command->info('There Are No Blog Post Or Users , So No Comments Will Be Added');
            return;
        }

        $CommentsCount = (int) $this->command->ask('How Many Comments Would You Like ?', 150);

        Comment::factory($CommentsCount)->make()->each(function ($comment) use ($users, $posts) {
            $comment->user_id = $users->random()->id;
            $comment->post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
