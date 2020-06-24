<?php

use App\Address;
use App\Cep;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ceps = Cep::all();
        factory(Address::class, 20)->make()->each(function($address) use ($ceps) {
          $ceps->random()->addresses()->save($address);
        });
    }
}
