<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;

trait InfoTrait
{
  public function info (Request $request)
  {
    $filters = $request->query;
    $query = $this->model->query();

    $query->when($projection = $filters->get('projection'), function($q) use ($projection) {
      return $q->selectRaw("MONTHNAME(created_at) as month, COUNT(id) as quantity")
        ->where('created_at', '>', Carbon::now()->subMonths($projection))
        ->groupByRaw('Year(created_at), Month(created_at)');
    });

    $query->when($grouped = $filters->get('grouped'), function($q) use ($grouped) {
      return $q->select('name')
        ->withCount("$grouped AS $grouped" . 'Count');
    });

    return response()->json($query->get());
  }
}
