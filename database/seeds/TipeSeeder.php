<?php

use App\Tipe;
use Illuminate\Database\Seeder;

class TipeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $tipes = [
      "blusa",
      "calça",
      "vestido"
    ];

    foreach ($tipes as $tipe) {
      Tipe::create(["tipe" => $tipe]);
    }
  }
}
