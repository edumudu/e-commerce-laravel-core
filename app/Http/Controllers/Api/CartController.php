<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Cart\CartInfoRequest;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function info(CartInfoRequest $request)
    {
        $cart = $request->get('cart', []);
        $products = Product::whereIn('id', $cart)
                    ->select('id', 'name', 'price', 'slug', 'inventory')
                    ->get();

        $products->transform(function($product){
          $product->photos->transform(fn($photo) => Storage::disk('upload')->url($photo->image));
          return $product;
        });

        return response()->json($products);
    }
}
