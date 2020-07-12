<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GenreRequest;
use App\Genre;
use App\Traits\InfoTrait;
use Exception;

class GenreController extends Controller
{
    use InfoTrait;

    public function __construct(Genre $genre)
    {
      $this->model = $genre;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $perPage = $request->query('per_page', 15);

      return response()->json(Genre::paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreRequest $request)
    {
      $genre = new Genre;
      $genre->name = $request->get('name');

      if (Genre::where('name', $genre->name)->first()) {
        return response()->json(['error' => 'Already existis an genre called ' . $genre->name], 409);
      }

      $genre->save();

      return response()->json(['message' => 'Successful created new Genre', 'genre' => $genre]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
      return response()->json($genre);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(GenreRequest $request, Genre $genre)
    {
      try {
        $genre->name = $request->get('name');
        $genre->save();
      
        return response()->json(['message' => 'Successful updated genre.', 'genre' => $genre]);
      } catch (Exception $err) {
        switch ($err->errorInfo[1]){
          case 1265: // Code for no valid genre
            $error = 'Not accept "' . $request->get('name') . '" as valid genre.';
            break;
          case 1062: // Code for duplicade value
            $error = 'Already existis an genre called "' . $request->get('name') . '".';
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
    public function destroy(Genre $genre)
    {
      $genre->delete();
        
      return response()->json(['message' => "Successful deleted genre $genre->name."]);
    }
}
