<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a user with a username and password
        User::factory()->create([
            'username' => 'TestUser',
            'password' => bcrypt('password123'), // Ensure the password is hashed
        ]);
    }
}
