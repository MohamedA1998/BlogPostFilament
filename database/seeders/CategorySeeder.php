<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $CategoryCount = max((int) $this->command->ask('How Many Category Would You Like ?', 5), 1);

        Category::factory($CategoryCount)->create();
    }
}
