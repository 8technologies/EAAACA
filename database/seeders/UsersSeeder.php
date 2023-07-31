<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admax', 
            'email' => 'admax@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admax@gmail.com'),
            'enabled' => true,
        ]);
        $user->syncRoles(['Administrator']);

        $user = User::create([
            'name' => 'Editor', 
            'email' => 'editor@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('editor@gmail.com'),
            'enabled' => true,
        ]);
        $user->syncRoles(['Editor']);
    }
}
