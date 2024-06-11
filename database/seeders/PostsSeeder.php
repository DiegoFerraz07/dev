<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('pt_BR');
        $user = User::select('id')->inRandomOrder()->limit(1)->first();
        for ($i = 0; $i < 10; $i++) {
            Post::create(
                [
                    'comments' => $faker->sentences(1, true),
                    'user_id' => $user->id,
                ]
            );
        }
    }
}
