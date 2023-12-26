<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $UserCount = max((int) $this->command->ask('How Many Users Would You Like ?', 25), 1);

        $adminEmail = 'admin@admin.com';

        $admin = User::whereEmail($adminEmail)->first();

        if (!$admin) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'role'  => User::ROLE_ADMIN
            ]);
        }

        $users = User::factory($UserCount)->create();
    }
}
