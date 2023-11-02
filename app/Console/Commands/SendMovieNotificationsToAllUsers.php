<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Console\Command;

class SendMovieNotificationsToAllUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:movie-notifications-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $token_list = User::whereNotNull('device_token')->pluck('device_token')->all();
        $server_key = 'AAAAuV9DE2Q:APA91bFfBruR1Tk1AqgHMt0bln7TlL-ZeK4XbnvyASv5fTBZZSm1hYFYExE7Hh6DWW-BHhwsjvbQ1W_kov2rixW6AXEei0-cIUatxj47pMo35jYeOwCD8qK0iYIFa6vkumDRdvJ4HbbY';
        $movie = Movie::all()->first();
        $data = [
            "registration_ids" => $token_list,
            "notification" => [
                "title" => $movie->title,
                "body" => $movie->rating,
            ]
        ];

        $data = json_encode($data);

        $headers = [
            'Authorization:key=' . $server_key,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);

        // Notifications
        $movie = Movie::latest()->first();
        $notification = new Notification;
        $notification->movie_id = $movie->id;

        $notification->save();
        $this->info('Push notifications sent to all users successfully.');
    }
}
