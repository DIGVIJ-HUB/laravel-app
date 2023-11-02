<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Notification;
use App\Models\Rating;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        $movies = Movie::all();
        $notis = Notification::orderBy('id','desc')->get()->take(3);
        foreach ($notis as $key => $value) {
            $movie_data[$key] = Movie::where('id', $value->movie_id)->first();
        }
        $notifications = $movie_data;
        return view('./frontend/home', compact('movies', 'notifications'));
    }

    public function movie($id)
    {
        $movie = Movie::where('id', $id)->first();
        $notis = Notification::all();
        foreach ($notis as $key => $value) {
            $movie_data[$key] = Movie::where('id', $value->movie_id)->first();
        }
        $notifications = $movie_data;
        return view('./frontend/single_movie', compact('movie', 'notifications'));
    }

    public function submitRating(Request $request)
    {
        if (Rating::where('user_id', Auth::user()->id)->where('movie_id', $request->movie_id,)->whereNotNull('edited_at')->first()) {
            Session::flash('warning', 'You can rate only once');
            return redirect()->back();
        } elseif (Rating::where('user_id', Auth::user()->id)->where('movie_id', $request->movie_id,)->first()) {
            $rating = Rating::where('user_id', Auth::user()->id)->where('movie_id', $request->movie_id,)->first();
            $rating->update([
                'rating' => $request->rating,
                'edited_at' => Carbon::now(),
            ]);
            Session::flash('success', 'Rating submitted');
            return redirect()->back();
        } else {
            $rating = Rating::create([
                'user_id' => Auth::user()->id,
                'movie_id' => $request->movie_id,
                'rating' => $request->rating,
            ]);
            Session::flash('success', 'Rating submitted');
            return redirect()->back();
        }
    }
}
