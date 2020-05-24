<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
        Category::create(["name" => $tipe]);
      }

      factory(Category::class, 20);
    }
}
