<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([

              RoleSeeder::class,
              CompanySeeder::class,

          ]);

        User::factory()->create([
            'name' => 'NIMPAGARITSE Léandre',
            'email' => 'leandrenimpagaritse22@gmail.com',
            'password' => bcrypt('leandre@2024'),
            'role_id' => 1, // Admin role id
        ]);
    }
}
