<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;

trait FilteredIndex
{
  public function index(Request $request)
    {
        $filters = $request->query;
        $perPage = $filters->get('per_page', $this->perPage ?? 15);
        $query = $this->model->query();

        $query->when($createdInTime = $filters->get('createdInTime'), function($q) use ($createdInTime) {
          return $q->where('created_at', '>=', Carbon::now()->subDays($createdInTime));
        });

        $users = $query->paginate($perPage);
        return response()->json($users);
    }
}
