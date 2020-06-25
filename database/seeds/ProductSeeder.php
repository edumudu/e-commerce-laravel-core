<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        $genres = \App\Genre::all();

        foreach($users as $user) {
          $product = factory(\App\Product::class)->make();
          $product->genre()->associate($genres->random());

          $user->products()->save($product);
        }
    }
}
