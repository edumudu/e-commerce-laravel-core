<?php

namespace App\Http\Controllers\Api;

use App\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Exception;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $products = Product::paginate(15);

    return response()->json($products); 
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $user = auth('api')->user();

    $product = new Product;
    $product->fill($request->only(['name', 'inventory', 'price', 'slug']));
    $product->genre()->associate(\App\Genre::find($request->get('genre')));
    $user->products()->save($product);

    $product->categories()->sync($request->get('categories'));

    foreach($request->file('photos') as $file){
      $path = $file->storeAs($product->slug, time() . '.' . $file->extension(), 'upload');
      $product->photos()->create(['image' => $path]);
    }
    
    return response()->json($product, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {    
    $product->load(['reviews', 'photos', 'categories', 'user', 'genre']);

    return response()->json($product);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Product $product)
  {
    Storage::disk('upload')->deleteDirectory($product->slug);
    $product->photos()->delete();

    $product->update($request->only(['name', 'inventory', 'price', 'slug']));
    $product->genre()->associate(Genre::find($request->get('genre')))->save();
    $product->categories()->sync($request->get('categories'));

    foreach($request->file('photos') as $file){
      $path = $file->storeAs($product->slug, time() . '.' . $file->extension(), 'upload');
      $product->photos()->create(['image' => $path]);
    }
    
    return response()->json($product);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Product $product)
  { 
    $product->photos->each(fn($photo) => Storage::disk('upload')->deleteDirectory($photo->image));
    $product->delete();

    return response()->json(['message' => "Successful deleted '$product->name'."]);
  }
}
