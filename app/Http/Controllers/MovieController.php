<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\TMDBHelper;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Support\Carbon;

class MovieController extends Controller
{
    
    public function category(Request $request, $id, $slug)
    {
        // Contoh mendapatkan film populer
        $popularMovies = TMDBHelper::discoverMovies($id, $request->page);
        $data = [
            'movies' => $popularMovies, 
            'categoryName' => collect(TMDBHelper::getMovieGenres())->keyBy('id')->get($id),
            'categorySlug' => $slug,
            'categoryID' => $id,
            'SEOData' => new SEOData(
                title: 'Situs Nonton Film '.collect(TMDBHelper::getMovieGenres())->keyBy('id')->get($id)['name'] . ' Terbaik di Indonesia',
                description: 'Situs Nonton Film '.collect(TMDBHelper::getMovieGenres())->keyBy('id')->get($id)['name']. ' Terbaik di Indonesia, menyajikan daftar film '.collect(TMDBHelper::getMovieGenres())->keyBy('id')->get($id)['name'] . ' terbaru dan terpopuler di Indonesia.',
            ),
        ];
        return view('public.movies.category', $data);
    }

    public function search(Request $request)
    {
        $movies = TMDBHelper::searchMovies($request->query('s'), $request->page);
        return view('public.movies.search', compact('movies'));
    }

    public function show($id, $slug)
    {
        $movie = TMDBHelper::getMovieDetails($id);
        $videos = TMDBHelper::getMovieVideos($id);
        $reviews = TMDBHelper::getMovieReviews($id);
        $SEOData = new SEOData(
            title: 'Nonton Film '.$movie['title'].' ('.Carbon::parse($movie['release_date'])->format('Y').') Sub Indo',
            description: 'Nonton Film '.$movie['title'].' ('.Carbon::parse($movie['release_date'])->format('Y').') Sub Indo, hanya di '.env('APP_NAME').' Situs Nonton Film Terbaik di Indonesia.',
        );
        return view('public.movies.show', compact('movie', 'videos', 'reviews', 'SEOData'));
    }
}
