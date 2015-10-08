<?php

namespace App\Http\Controllers;

use App\Podcasts;
use App\Http\Requests;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $podcasts = Podcasts::all();
        $guests = Podcasts::getGuests( $podcasts );

        return view('index', ['podcasts' => $podcasts, 'guests' => $guests ]);
    }

}
