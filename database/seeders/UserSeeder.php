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
        User::create(
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => "12345678",
            ]
        );
        $faker = \Faker\Factory::create('pt_BR');
        for ($i = 0; $i < 10; $i++) {
            User::create(
                [
                    'name' => $faker->word(),
                    'email' => $faker->unique()->email(),
                    'password' => "12345678",
                ]
            );
        }
    }
}
