<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
     
        echo "Truncating tables...\n";
        try {
            DB::statement("SET foreign_key_checks=0");
            $this->call([TruncateSeeder::class]);
            DB::statement("SET foreign_key_checks=1");
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage()  . $e->getTraceAsString() . "\n";
            return;
        }
        echo "Tables truncated successfully.\n\n";
        $this->call(UserSeeder::class);
        $this->call(PostsSeeder::class);
    }
}
