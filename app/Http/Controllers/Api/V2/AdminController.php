<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        $movies = Movie::all();
        return response()->json([
            'result' => true,
            'data' => $movies
        ]);
    }

    public function addMovie(Request $request)
    {
        // Validation
        $validator = $this->validateMovie($request);
        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $rating = Movie::create([
            'user_id'           => Auth::user()->id,
            'title'             => $request->title,
            'description'       => $request->description,
            'runtime'           => $request->runtime,
            'publication_date'  => $request->publication_date,
            'image'             => $request->image,
        ]);

        return response()->json([
            'result' => true,
            'message' => 'Movie data added'
        ]);
    }

    public function movieData($id)
    {
        $movie = Movie::find($id);
        return response()->json([
            'result' => true,
            'data' => $movie
        ]);
    }

    public function updateMovie(Request $request)
    {
        $movie = Movie::find($request->movie_id);

        try {
            $this->authorize('update', $movie);
            $movie->update([
                'title'             => $request->title,
                'description'       => $request->description,
                'runtime'           => $request->runtime,
                'image'             => $request->image,
                'publication_date'  => $request->publication_date,
            ]);

            return response()->json([
                'result' => true,
                'message' => 'Movie edited'
            ]);
        } catch (\Throwable $th) {

            return response()->json([
                'result' => false,
                'message' => 'You do not own this movie'
            ], 400);
        }
    }

    private function validateMovie(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title'             => 'required',
            'description'       => 'required|min:10',
            'runtime'           => 'required',
            'image'             => 'required|url',
            'publication_date'  => 'required',
        ]);
        return $validate;
    }
}
