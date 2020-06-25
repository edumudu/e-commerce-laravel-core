<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\UserOrder;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
  public function index(Request $request)
  {
    $perPage = $request->query('per_page', 15);
    $orders = UserOrder::paginate($perPage);

    return response()->json($orders);
  }
}
