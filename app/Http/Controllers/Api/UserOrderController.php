<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\UserOrder;
use Illuminate\Http\Request;
use App\Traits\InfoTrait;
use App\Traits\FilteredIndex;

class UserOrderController extends Controller
{
  use InfoTrait, FilteredIndex;

  private $model;

  public function __construct(UserOrder $userOrder) {
    $this->model = $userOrder;
  }
}
