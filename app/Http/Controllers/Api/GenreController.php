<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Genre;
use Exception;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response()->json(Genre::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $Genre = new Genre;
      $Genre->genre = $request->genre;

      if (Genre::where('genre', $Genre->genre)->first()) {
        return response()->json(['error' => 'Already existis an genre called ' . $Genre->genre], 409);
      }

      $Genre->save();

      return response()->json(['message' => 'Successful created new Genre', 'genre' => $Genre]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $genreUri
     * @return \Illuminate\Http\Response
     */
    public function show($genreUri)
    {
      if(!$genre = Genre::where('genre', $genreUri)->first())
        return response()->json(['error' => "Not found '$genreUri'"], 404);

      return response()->json($genre);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $genreUri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $genreUri)
    {
      if(!$genre = Genre::where('genre', $genreUri)->first())
        return response()->json(['error' => "Genre $genreUri not exists."] , 404);

      try {
        $genre->update($request->only('genre'));
      
        return response()->json(['message' => "Successful updated genre $genre->genre.", 'genre' => $genre]);
      } catch (Exception $err) {
        switch ($err->errorInfo[1]){
          case 1265: // Code for no valid genre
            $error = "Not accept '$request->genre' as valid genre.";
            break;
          case 1062: // Code for duplicade value
            $error = "Already existis an genre called '$request->genre'.";
            break;
        }

        return response()->json(['error' => $error], 400);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $genreUri
     * @return \Illuminate\Http\Response
     */
    public function destroy($genreUri)
    {
      if(!$genre = Genre::where('genre', $genreUri)->first())
        return response()->json(['error' => "Not found genre '$genreUri'."]);

      $genre->delete();
        
      return response()->json(['message' => 'Successful deleted genre ' . $genre->genre . '.']);
    }
}
