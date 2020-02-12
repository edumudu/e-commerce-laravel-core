<?php

use App\Img;
use App\Tipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imgs = [
            'https://i.pinimg.com/236x/f9/f5/08/f9f50838dfe8f7aedae05f2e865d05f3.jpg',
            'https://cori.vteximg.com.br/arquivos/ids/196007-514-514/05.35.043333101.jpg?v=636785681625100000',
            'https://assets.xtechcommerce.com/uploads/images/medium/e648cc9c40b034e437786e90d55f223d.jpg'
        ];

        Img::create([
            "path"     => array_rand($imgs),
            "tipe_ref" => rand(1, Tipe::all()->count())
        ]);
    }
}
