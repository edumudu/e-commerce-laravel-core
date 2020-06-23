<?php

use App\Cep;
use Illuminate\Database\Seeder;

class CepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cep::create(['cep' => '30626495']);
    }
}
