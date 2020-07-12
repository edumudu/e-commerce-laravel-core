<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Product;
use App\Review;
use App\Traits\InfoTrait;
use App\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use InfoTrait;

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
    public function store(ReviewRequest $request)
    {
      $product = Product::find($request->get('product'));

      $review = new Review($request->validated());
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
    public function update(ReviewRequest $request, Review $review)
    {
      if(!$request->user->reviews->contains($review))
        return response()->json(['error' => "User not have permission to edit this review."], 403);

      $review->update($request->validated());

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
