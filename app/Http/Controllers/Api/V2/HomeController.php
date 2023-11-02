<?php

namespace App\Http\Controllers\Api\V2;

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
        return response()->json([
            'result' => true,
            'data' => $movies
        ]);
    }

    public function movie($id)
    {
        $movie = Movie::where('id', $id)->first();
        return response()->json([
            'result' => true,
            'data' => $movie
        ]);
    }

    public function notifications()
    {
        $notis = Notification::all();
        foreach ($notis as $key => $value) {
            $movie_data[$key] = Movie::where('id', $value->movie_id)->first();
        }
        $notifications = $movie_data;
        return response()->json([
            'result' => true,
            'data' => $notifications
        ]);
    }

    public function submitRating(Request $request)
    {
        if (Rating::where('user_id', Auth::user()->id)->where('movie_id', $request->movie_id,)->whereNotNull('edited_at')->first()) {
            return response()->json([
                'result'  => true,
                'message' => 'You can rate only once'
            ]);
        } elseif (Rating::where('user_id', Auth::user()->id)->where('movie_id', $request->movie_id,)->first()) {
            $rating = Rating::where('user_id', Auth::user()->id)->where('movie_id', $request->movie_id,)->first();
            $rating->update([
                'rating' => $request->rating,
                'edited_at' => Carbon::now(),
            ]);
            return response()->json([
                'result'  => true,
                'message' => 'Rating submitted'
            ]);
        } else {
            $rating = Rating::create([
                'user_id' => Auth::user()->id,
                'movie_id' => $request->movie_id,
                'rating' => $request->rating,
            ]);
            return response()->json([
                'result'  => true,
                'message' => 'Rating submitted'
            ]);
        }
    }
}
