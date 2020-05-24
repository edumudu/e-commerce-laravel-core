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
            CategorySeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
