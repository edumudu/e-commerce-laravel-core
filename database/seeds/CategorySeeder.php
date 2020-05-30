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
        "blusa" => "blusa",
        "calça" => "calca",
        "vestido" => 'vestido'
      ];
  
      foreach ($tipes as $key => $tipe) {
        Category::create(["name" => $tipe, 'slug' => $key]);
      }

      factory(Category::class, 20);
    }
}
