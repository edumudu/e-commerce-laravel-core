<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GenreSeeder::class,
            TipeSeeder::class,
            ImgSeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
        ]);
    }
}
