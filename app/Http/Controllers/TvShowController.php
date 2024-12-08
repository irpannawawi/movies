<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\TMDBHelper;

class TvShowController extends Controller
{
    public function category($id, $slug)
    {
        // Contoh mendapatkan film populer
        $popularMovies = TMDBHelper::getNowPlaying(1);
        $data = [
            'popularMovies' => $popularMovies
        ];
        return view('public.index', $data);
    }
}
