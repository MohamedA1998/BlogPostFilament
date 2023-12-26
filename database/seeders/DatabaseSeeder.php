<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if ($this->command->confirm('Do You Want To Refresh The Database', true)) {
            $this->command->call('migrate:refresh');
            $this->command->info('DataBase Was Refreshed');
        }

        // Forget All Data Was Cached
        Cache::flush();

        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            CategorySeeder::class,
            UserLikePostTableSeeder::class,
            CategoryPostTableSeeder::class
        ]);
    }
}
