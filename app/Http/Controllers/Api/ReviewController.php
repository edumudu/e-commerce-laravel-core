<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\ReviewCreateRequest;
use App\Http\Requests\Review\ReviewEditingRequest;
use App\Product;
use App\Review;
use App\Traits\InfoTrait;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    public function store(ReviewCreateRequest $request, Product $product)
    {
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
    public function update(ReviewEditingRequest $request, Product $product, Review $review)
    {
      if($review->product_id !== $product->id) {
        throw new ModelNotFoundException;
      }

      $review->update($request->validated());

      return response()->json(['message' => "Successful updated review.", 'review' => $review]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product, Review $review)
    {
      if($review->product_id !== $product->id) {
        throw new ModelNotFoundException;
      }

      if(!$request->user->can('delete', $review)) {
        throw new AuthorizationException('This action is unauthorized.');
      }

      $review->delete();

      return response()->json(['message' => "Successful deleted review."]);
    }
}
