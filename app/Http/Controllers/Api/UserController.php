<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->query;
        $perPage = $filters->get('per_page', 15);
        $query = User::query();

        $query->when($filters->get('createdInTime'), function($q) use ($filters) {
          return $q->where('created_at', '>', DB::raw('DATE_SUB(NOW(), INTERVAL ' . $filters->get('createdInTime') . ' DAY)'));
        });

        $users = $query->paginate($perPage);
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function info(Request $request) {
      $filters = $request->query;
      $query = User::query();

      if($projection = $filters->get('projection')) {
        $query->when($filters, function($q) use ($projection) {
          return $q->select(DB::raw("MONTHNAME(created_at) as month, COUNT(id) as quantity"))
            ->where('created_at', '>', DB::raw("DATE_SUB(NOW(), INTERVAL $projection MONTH)"))
            ->groupBy(DB::raw('Year(created_at), Month(created_at)'));
        });
      }

      $data = $query->get();
      return response()->json($data);
    }
}
