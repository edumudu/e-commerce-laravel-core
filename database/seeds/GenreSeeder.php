<?php

use App\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            "Feminine",
            "Male"
        ];

        Genre::create([
            "id"    => null,
            "genre" => array_rand($genres)
        ]);
    }
}
