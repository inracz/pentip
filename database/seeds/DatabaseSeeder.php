<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        App\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ]);

        factory(App\User::class, 5)->create()->each(function($user) {
            $postCount = rand(1,5);

            for ($i = 0; $i < $postCount; $i++) {
                $user->posts()->save(factory(App\Post::class)->make());
            }

        });
    }
}
