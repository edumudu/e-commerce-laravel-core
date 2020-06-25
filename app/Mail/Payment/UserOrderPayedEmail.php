<?php

namespace App\Mail\Payment;

use App\UserOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserOrderPayedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserOrder $userOrder)
    {
        $this->order = $userOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_CONTACT_ADDRESS'), env('APP_NAME'))
                    ->subject('Approved payment')
                    ->view('mail.payment.user-payed')
                    ->with($this->order->toArray());
    }
}
