<?php

namespace App\Policies;

use App\Product;
use App\Review;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create reviews.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Product $product)
    {
      $order = $user->orders()
        ->where('items', 'like', '%"id":' . $product->id . '%')
        ->where('pagseguro_status', 3)
        ->first();

      return $order && $user->reviews()->where('product_id', $product->id)->doesntExist();
    }

    /**
     * Determine whether the user can update the review.
     *
     * @param  \App\User  $user
     * @param  \App\Review  $review
     * @return mixed
     */
    public function update(User $user, Review $review)
    {
        return $user->id === $review->user_id;
    }

    /**
     * Determine whether the user can delete the review.
     *
     * @param  \App\User  $user
     * @param  \App\Review  $review
     * @return mixed
     */
    public function delete(User $user, Review $review)
    {
        return $user->id === $review->user_id || $this->user->role === 'admin';
    }
}
