<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Payment\PagSeguro\CreditCard;
use App\Product;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CheckoutController extends Controller
{
    public function process(Request $request) {
      try {
        $cart = collect($request->get('cart', []))->sortBy('id');
        
        $data = $request->only(['token', 'hash', 'installment', 'name']);
        $user = $request->user;
        $reference = Uuid::uuid4()->toString();
        
        $cartItems = Product::whereIn('id', $cart->pluck('id'))
          ->get()
          ->transform(function($item, $key) use ($cart) {
            $item['quantity'] = $cart[$key]['quantity'];
            return $item;
          });

        $creditCardPayment = new CreditCard($cartItems->all(), $user, $data, $reference);
        $result = $creditCardPayment->doPayment();

        $userOrder = $user->orders()->create([
          'reference'        => $reference,
          'pagseguro_code'   => $result->getCode(),
          'pagseguro_status' => $result->getStatus(),
          'items'            => $cartItems->toJson()
        ]);

        return response()->json([
          'message' => 'Successful purchased',
          'order'   => $userOrder
        ]);
      } catch (\Throwable $th) {
        if(strpos($th->getMessage(), 'xml')) {
          $message  = simplexml_load_string($th->getMessage());
        } else {
          $message  = ['error' => ['message' => $th->getMessage()]];
        }

        return response()->json(env('APP_DEBUG') ? $message : 'Erro ao processar pedido', 401);
      }
    }

    public function makePagSeguroSession() {
      if(!session()->has('pagseguro_session_code')) {
        $sessionCode = \PagSeguro\Services\Session::create(
          \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        session()->put('pagseguro_session_code', $sessionCode->getResult());
      }
      
      return response()->json(['sessionId' => session()->get('pagseguro_session_code')]);
    }
}
