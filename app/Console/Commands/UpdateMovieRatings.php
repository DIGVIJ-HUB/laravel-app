<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateMovieRatings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:movie-ratings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update movie ratings based on last 30 days reviews';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        $reviews = Rating::where('created_at', '>=', $thirtyDaysAgo)
            ->get();

        $movies = Movie::all();
        foreach ($movies as $movie) {
            $reviewsForMovie = $reviews->where('movie_id', $movie->id);
            $averageRating = $reviewsForMovie->avg('rating');

            $movie->rating = $averageRating;
            $movie->save();
        }

        $this->info('Movie ratings updated successfully.');
    }
}
