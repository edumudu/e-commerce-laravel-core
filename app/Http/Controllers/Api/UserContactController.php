<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Contact\UserContactRequest;
use App\Mail\UserContactEmail;
use Exception;
use Illuminate\Support\Facades\Mail;

class UserContactController extends Controller
{
    public function contact(UserContactRequest $request)
    {
      try {
        Mail::to(env('MAIL_CONTACT_ADDRESS'))->send(new UserContactEmail($request->validated()));

        return response()->json(['message' => 'Successful send contact message!']);
      } catch(Exception $e) {
        $message = env('APP_ENV') === 'production' ? 'Something went wrong try again later' : $e->getMessage();

        return response()->json(['error' => $message]);
      }
    }
}
