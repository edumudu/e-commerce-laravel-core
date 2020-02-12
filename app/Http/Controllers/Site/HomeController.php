<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {
        $slides = [
            [
                'img'  => 'https://p.bigstockphoto.com/GeFvQkBbSLaMdpKXF1Zv_bigstock-Aerial-View-Of-Blue-Lakes-And--227291596.jpg',
                'name' => 'Landscape'
            ],
            [
                'img'  => 'https://as.ftcdn.net/r/v1/pics/7b11b8176a3611dbfb25406156a6ef50cd3a5009/home/discover_collections/optimized/image-2019-10-11-11-36-27-681.jpg',
                'name' => 'imagem 2 hehe'
            ]
        ];
        $destaques = [
            [
                'ID'    => 1,
                'name'  => 'Produto 1',
                'preco' => 2.45,
                'img'   => 'https://www.vestbrasil.com.br/media/catalog/product/cache/1/image/800x/9df78eab33525d08d6e5fb8d27136e95/b/l/blusa_mikaela_-_mk02-fem_2_.jpg'
            ],
            [
                'ID'    => 2,
                'name'  => 'Produto 2',
                'preco' => 12.45,
                'img'   => 'https://www.vestbrasil.com.br/media/catalog/product/cache/1/image/800x/9df78eab33525d08d6e5fb8d27136e95/b/l/blusa_mikaela_-_mk02-fem_2_.jpg'
            ],
            [
                'ID'    => 3,
                'name'  => 'Produto 3',
                'preco' => 10.45,
                'img'   => 'https://www.vestbrasil.com.br/media/catalog/product/cache/1/image/800x/9df78eab33525d08d6e5fb8d27136e95/b/l/blusa_mikaela_-_mk02-fem_2_.jpg'
            ],
            [
                'ID'    => 4,
                'name'  => 'Produto 4',
                'preco' => 20.45,
                'img'   => 'https://www.vestbrasil.com.br/media/catalog/product/cache/1/image/800x/9df78eab33525d08d6e5fb8d27136e95/b/l/blusa_mikaela_-_mk02-fem_2_.jpg'
            ]
        ];

        $slides = array_map(function($x) { return (object)$x; }, $slides);
        $destaques = array_map(function($x) { return (object)$x; }, $destaques);
        
        return view('home', compact('slides', 'destaques'));
    }
}
