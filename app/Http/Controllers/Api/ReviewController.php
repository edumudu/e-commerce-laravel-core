<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    public function index()
    {
      return response()->json(Review::all());
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

      if(!User::find($request->prod_ref))
        return response()->json(['error' => 'Not found product'], 400);

      $review = new Review;
      $review->fill($request->only(['prod_ref', 'user_ref', 'review', 'rating']));
      $review->writed_at = date('Y-m-d');
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
      if(!$review = Review::find($id))
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
