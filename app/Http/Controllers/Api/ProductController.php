<?php

namespace App\Http\Controllers\Api;

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
    return response()->json(Product::all()); 
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $file = $request->file('thumb');

    $product = new Product;
    $product->fill($request->only(['name', 'estoque', 'price', 'tipe_ref', 'genre_ref']));
    $product->img_folder = Storage::disk('upload')->url('');
    $product->save();

    $product->update(['img_folder' => $product->img_folder . $product->id]);
    
    $file->storeAs($product->id, 'thumb.' . $file->extension(), 'upload');
    
    return response()->json($product, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    if (!$product = Product::find($id))
      return response()->json(['error' => "Not found product with id $id."], 404);
    
    return response()->json($product);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    if (!$product = Product::find($id))
      return response()->json(['error' => "Not found product with id '$id'"]);

    $product->update($request->only(['name', 'estoque', 'price', 'tipe_ref', 'genre_ref']));
    
    $file = $request->file('thumb');
    $file->storeAs($id, 'thumb.' . $file->extension(), 'upload');
    
    return response()->json($product);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    if (!$product = Product::find($id))
      return response()->json(['error' => "Not found product with id '$id'."], 404);
    
    Storage::disk('upload')->deleteDirectory($id);
    $product->delete();

    return response()->json(['message' => "Successful deleted '$product->name'."]);
  }
}
