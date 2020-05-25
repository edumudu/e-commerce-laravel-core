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
    Genre::create(["name" => "feminine"]);
    Genre::create(["name" => "male"]);
  }
}
