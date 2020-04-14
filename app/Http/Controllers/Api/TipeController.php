<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Tipe;
use Exception;
use Illuminate\Http\Request;

class TipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response()->json(Tipe::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $Tipe = new Tipe;
      $Tipe->tipe = $request->tipe;

      if (Tipe::where('tipe', $Tipe->tipe)->first())
        return response()->json(['error' => "Already existis tipe called '$Tipe->tipe'."], 409);
      
      $Tipe->save();

      return response()->json(['message' => "Successful created tipe '$Tipe->tipe'", 'tipe' => $Tipe], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $tipeParam
     * @return \Illuminate\Http\Response
     */
    public function show($tipeParam)
    {
      if(!$Tipe = Tipe::where('tipe', $tipeParam)->first())
        return response()->json(['error' => "Not found tipe called '$tipeParam'."], 404);

      return response()->json($Tipe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $tipeParam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tipeParam)
    {
      if(!$Tipe = Tipe::where('tipe', $tipeParam)->first())
        return response()->json(['error' => "Not found tipe called '$tipeParam'."], 404);
      
      try {
        $Tipe->update($request->only(['tipe']));

        return response()->json(['message' => "Successful updated tipe $Tipe->tipe.", 'tipe' => $Tipe]);
      } catch (Exception $err) {
        return response()->json(['error' => "Already existis tipe called '" . $request->tipe ."'."], 409);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $tipeParam
     * @return \Illuminate\Http\Response
     */
    public function destroy($tipeParam)
    {
      if(!$Tipe = Tipe::where('tipe', $tipeParam)->first())
        return response()->json(['error' => "Not found tipe called '$tipeParam'."], 404);
        
      $Tipe->delete();

      return response()->json(['message' => "Successful deleted tipe '$tipeParam'."]);
    }
}
