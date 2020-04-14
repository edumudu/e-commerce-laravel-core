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
    Genre::create(["genre" => "feminine"]);
    Genre::create(["genre" => "male"]);
  }
}
