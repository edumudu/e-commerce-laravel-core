<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response()->json(Category::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $category = new Category($request->all());

      if (Category::where('name', $category->name)->first())
        return response()->json(['error' => "Already existis category called '$category->name'."], 409);
      
      $category->save();

      return response()->json(['message' => "Successful created tipe '$category->name'", 'tipe' => $category], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
      $category->load('products')->paginate(15);

      return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    { 
      try {
        $category->update($request->only(['name']));

        return response()->json(['message' => "Successful updated tipe $category->name.", 'tipe' => $category]);
      } catch (Exception $err) {
        return response()->json(['error' => "Already existis tipe called '" . $request->category ."'."], 409);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {   
      $category->delete();

      return response()->json(['message' => "Successful deleted tipe '$category->name'."]);
    }
}
