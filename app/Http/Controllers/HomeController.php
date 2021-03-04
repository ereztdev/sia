<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function Couchbase\defaultDecoder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $apiKey = 'ZUH4DVXQWPS8XBS2DNTZ';
        $apiSecret = '$zzb6HD4zq#rr3y2hwL2c6k7t^cAr9k3a#PWnapF';
        $apiHeaderTime = time();
        $hash = sha1($apiKey.$apiSecret.$apiHeaderTime);
        $headers = [
            "User-Agent: SuperPodcastPlayer/1.3",
            "X-Auth-Key: $apiKey",
            "X-Auth-Date: $apiHeaderTime",
            "Authorization: $hash"
        ];

        //Make the request to an API endpoint
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.podcastindex.org/api/1.0/search/byterm?q=rogan");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//Collect and show the results
        $podcastResponse = curl_exec ($ch);
        curl_close ($ch);

        $user = auth()->user();
        $userName = $user->name;
        $accessToken = $user->createToken('authToken')->accessToken;

        return view('home', compact('accessToken', 'userName', 'podcastResponse'));
    }
}
