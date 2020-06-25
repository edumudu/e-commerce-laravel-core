<?php

namespace App\Observers;

use App\Mail\Payment\UserOrderCreatedEmail;
use App\UserOrder;
use Illuminate\Support\Facades\Mail;

class UserOrderObserver
{
    public function retrieved(UserOrder $userOrder)
    {
      $userOrder->items = collect(json_decode($userOrder->items));
    }

    /**
     * Handle the user order "created" event.
     *
     * @param  \App\UserOrder  $userOrder
     * @return void
     */
    public function created(UserOrder $userOrder)
    {
        $userOrder->items = collect(json_decode($userOrder->items));
        Mail::to($userOrder->user->email)->send(new UserOrderCreatedEmail($userOrder));
    }

    /**
     * Handle the user order "updated" event.
     *
     * @param  \App\UserOrder  $userOrder
     * @return void
     */
    public function updated(UserOrder $userOrder)
    {
        //
    }

    /**
     * Handle the user order "deleted" event.
     *
     * @param  \App\UserOrder  $userOrder
     * @return void
     */
    public function deleted(UserOrder $userOrder)
    {
        //
    }

    /**
     * Handle the user order "restored" event.
     *
     * @param  \App\UserOrder  $userOrder
     * @return void
     */
    public function restored(UserOrder $userOrder)
    {
        //
    }

    /**
     * Handle the user order "force deleted" event.
     *
     * @param  \App\UserOrder  $userOrder
     * @return void
     */
    public function forceDeleted(UserOrder $userOrder)
    {
        //
    }
}
