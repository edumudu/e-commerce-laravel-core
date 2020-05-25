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
    public function index(User $user)
    {
      return response()->json($user->reviews()->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(!$product = Product::find($request->get('product')))
        return response()->json(['error' => 'Not found product'], 400);

      $review = new Review($request->all());
      $review->user()->associate($request->user);
      $product->reviews()->save($review);

      return response()->json($review, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
      return response()->json($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
      if(!$request->user->reviews->contains($review))
        return response()->json(['error' => "User not have permission to edit this review."], 403);

      $review->update($request->only(['review', 'rating']));

      return response()->json(['message' => "Successful updated review.", 'review' => $review]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Review $review)
    {
      if(!$request->user->reviews->contains($review))
        return response()->json(['error' => "User not have permission to delete this review."], 403);
      
      $review->delete();

      return response()->json(['message' => "Successful deleted review."]);
    }
}
