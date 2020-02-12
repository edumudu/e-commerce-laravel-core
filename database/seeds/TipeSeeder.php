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
            "Blusa",
            "Calça",
            "Vestido"
        ];

        Tipe::create([
            "tipe" => array_rand($tipes)
        ]);
    }
}
