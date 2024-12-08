<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\TMDBHelper;



class PublicController extends Controller
{
    public function index()
    {

        // Contoh mendapatkan film populer
        $nowPlayingMovies = TMDBHelper::getNowPlaying(1);
        $trendingMovies = TMDBHelper::getTrending(1);
        $data = [
            'trendingMovies' => $trendingMovies,
            'nowPlayingMovies' => $nowPlayingMovies
        ];
        return view('public.index', $data);
    }


}
