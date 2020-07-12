<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Payment\PagSeguro\CreditCard;
use App\Product;
use Ramsey\Uuid\Uuid;
use App\Http\Requests\Payment\PagSeguroDirectPayment;
use App\Mail\Payment\StoreOrderPayedEmail;
use App\Mail\Payment\UserOrderPayedEmail;
use App\Payment\PagSeguro\Notification;
use App\UserOrder;
use Exception;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function process(PagSeguroDirectPayment $request) {
      try {
        $data = $request->validated();
        $cart = collect($data['cart'])->sortBy('id');
        $user = $request->user;
        $reference = Uuid::uuid4()->toString();
        
        $cartItems = Product::whereIn('id', $cart->pluck('id'))
          ->get()
          ->transform(function($item, $key) use ($cart) {
            $item['quantity'] = $cart[$key]['quantity'];
            return $item;
          });

        $data = array_merge($data, $data['sameAsRegister'] ? [
          'apto' => $user->address->address()->apto,
          'number' => $user->address->address()->number,
          'cep' => $user->address->address()->cep
        ] : []);

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

        return response()->json(env('APP_DEBUG') ? $message : 'Erro ao processar pedido', 403);
      }
    }

    public function notification()
    {
      try {
        $notification = new Notification();
        $notification = $notification->getTransaction();

        $userOrder = UserOrder::whereReference($notification->getReference())->first();
        $userOrder->update([
          'pagseguro_status' => $notification->getStatus()
        ]);


        if((int)$notification->getStatus() === 3) {
          // Liberar pedido do usario
          // Atualizar status para em sepracao
          Mail::to($userOrder->user->email)->send(new UserOrderPayedEmail($userOrder));
          Mail::to(env('MAIL_CONTACT_ADDRESS'))->send(new StoreOrderPayedEmail($userOrder));
        }

        return response()->json([], 204);
      } catch (Exception $e) {
        $message = env('APP_DEBUG') ? $e->getMessage() : '';
        return response()->json(['error' => $message], 500);
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
