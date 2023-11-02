<?php

namespace App\Http\Controllers;

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
        return view('./backend/dashboard', compact('movies'));
    }

    public function addMovie(Request $request)
    {
        // Validation
        $validator = $this->validateMovie($request);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $rating = Movie::create([
            'user_id'           => Auth::user()->id,
            'title'             => $request->title,
            'description'       => $request->description,
            'runtime'           => $request->runtime,
            'publication_date'  => $request->publication_date,
            'image'             => $request->image,
        ]);

        session()->put('success', 'Movie data added');
        return redirect()->back();
    }

    public function movieData($id)
    {
        $movie = Movie::find($id);
        return response()->json($movie);
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
            Session::flash('success', 'Movied edited');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('warning', "You do not own this movie");
            return redirect()->back();
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
