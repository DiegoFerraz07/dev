<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TruncateSeeder extends Seeder
{
    
    public function run(): void
    {
		DB::table('posts')->truncate();
		DB::table('users')->truncate();
    }
}
