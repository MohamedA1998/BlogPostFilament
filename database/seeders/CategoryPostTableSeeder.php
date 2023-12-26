<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Categorys = Category::all();

        $posts = Post::all();

        for ($i = 0; $i < count($posts); $i++) {
            DB::table('category_post')->insert([
                'category_id' => $Categorys->random()->id,
                'post_id' => $posts->random()->id,
            ]);
        }
    }
}
