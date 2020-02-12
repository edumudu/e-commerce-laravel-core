<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('site.products', compact('products'));
    }

    public function single_prod($id)
    {
        $product = Product::find($id);
        return view('site.products_single', compact('product'));
    }
}
