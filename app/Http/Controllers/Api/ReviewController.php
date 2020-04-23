<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\Review;
use App\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      return response()->json(
        Review::join('users', 'users.id', '=', 'tb_reviews.user_ref')
          ->where('prod_ref', $request->query('prod_id'))
          ->select('users.name as user', 'tb_reviews.id', 'tb_reviews.review', 'tb_reviews.rating', 'tb_reviews.created_at')
          ->get()
      );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(!User::find($request->user_ref))
        return response()->json(['error' => 'Not found user'], 400);

      if(!Product::find($request->prod_ref))
        return response()->json(['error' => 'Not found product'], 400);

      $review = new Review;
      $review->fill($request->only(['prod_ref', 'user_ref', 'review', 'rating']));
      $review->save();

      return response()->json($review, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $review = Review::join('users', 'users.id', '=', 'tb_reviews.user_ref')
        ->where('tb_reviews.id', $id)
        ->select('users.name as user', 'tb_reviews.id', 'tb_reviews.review', 'tb_reviews.rating', 'tb_reviews.created_at')
        ->first();

      if(!$review)
        return response()->json(['error' => "Not found review id '$id'"], 404);
      
      return response()->json($review);
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
      if(!$review = Review::find($id))
        return response()->json(['error' => "Not found review id '$id'"], 404);

      if($review->user_ref !== auth('api')->user()->id)
        return response()->json(['error' => "User not have permission to edit this review '$id'"], 403);

      $review->update($request->only(['prod_ref', 'user_ref', 'review', 'rating']));

      return response()->json(['message' => "Successful updated review with id '$id'", 'review' => $review]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if(!$review = Review::find($id))
        return response()->json(['error' => "Not found review id '$id'"], 404);

      if($review->user_ref !== auth('api')->user()->id)
        return response()->json(['error' => "User not have permission to delete this review '$id'"], 403);
      
      $review->delete();

      return response()->json(['message' => "Successful deleted review with id '$id'"]);
    }
}
