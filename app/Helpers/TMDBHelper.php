<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use App\Helpers\TMDB\Movie;
class TMDBHelper
{
    protected static $baseUrl;
    protected static $apiKey;

    public static function init()
    {
        self::$baseUrl = config('services.tmdb.base_url', env('TMDB_API_URL'));
        self::$apiKey = config('services.tmdb.api_key', env('TMDB_API_KEY'));
    }

    // Fungsi untuk melakukan request ke TMDB
    protected static function request($endpoint, $params = [])
    {
        self::init();
        $params['api_key'] = self::$apiKey;
        $response = Http::get(self::$baseUrl . $endpoint, $params);

        return $response->json();
    }

    // Contoh fungsi mendapatkan daftar film populer
    public static function getPopularMovies($page = 1)
    {
        return cache()->remember('popular_movies_'.$page, now()->addDays(1), function () use ($page) {
            return self::request('/movie/popular', ['page' => $page]);
        });
    }

    public static function getNowPlaying($page = 1)
    {
        return cache()->remember('now_playing_'.$page, now()->addDays(1), function () use ($page) {
            return self::request('/movie/now_playing', ['page' => $page]);
        });
    }    
    
    public static function getImage($file, $width=1920)
    {
        $url = 'https://image.tmdb.org/t/p/w'.$width.$file;
        return $url;
    }
    // Fungsi mendapatkan detail film berdasarkan ID
    public static function getMovieDetails($movieId)
    {
        return cache()->remember("movie:{$movieId}", now()->addDays(7), function () use ($movieId) {
            $movie = self::request("/movie/{$movieId}", [
                'language' => env('APP_LOCALE').'|'.env('APP_FALLBACK_LOCALE')
            ]);
            $movie['created_at'] = now();
            $movie['updated_at'] = now();
            return $movie;
        });
    }

    // Fungsi mencari film berdasarkan kata kunci
    public static function searchMovies($query, $page = 1)
    {
        return self::request('/search/movie', [
            'query' => $query, 
            'page' => $page,
            'language' => env('APP_LOCALE')
        ]);
    }

    // Fungsi mendapatkan daftar TV show populer
    public static function getPopularTVShows($page = 1)
    {
        return self::request('/tv/popular', ['page' => $page]);
    }

    // Fungsi mendapatkan detail TV show berdasarkan ID
    public static function getTVShowDetails($tvId)
    {
        return self::request("/tv/{$tvId}");
    }

    // Fungsi mendapatkan daftar aktor populer
    public static function getPopularActors($page = 1)
    {
        return self::request('/person/popular', ['page' => $page]);
    }

    // Fungsi mendapatkan detail aktor berdasarkan ID
    public static function getActorDetails($actorId)
    {
        return self::request("/person/{$actorId}");
    }

    // Fungsi untuk mendapatkan genre film
    public static function getMovieGenres()
    {
        $cacheKey = 'movie_genres';
        $genres = cache()->remember($cacheKey, now()->addDays(7), function() {
            return self::request('/genre/movie/list', [
                'language' => env('APP_LOCALE')
            ]);
        });
        return $genres['genres'];
    }

    public static function discoverMovies($genres, $page = 1)
    {
        $cacheKey = 'discover_movie_genres.'.$genres.'.'.$page;
        $genres = cache()->remember($cacheKey, now()->addDays(2), function() use ($genres, $page) {
            return self::request('/discover/movie', [
                'language' => env('APP_LOCALE'),
                'with_genres' => $genres,
                'order_by' => 'release_date.desc',
                'page' => $page
            ]);
        });
        return $genres;
    }
    public static function getTvGenres()
    {
        $cacheKey = 'tv_genres';
        $genres = cache()->remember($cacheKey, now()->addDays(7), function() {
            return self::request('/genre/tv/list', [
                'language' => env('APP_LOCALE')
            ]);
        });
        return $genres['genres'];
    }

    // Fungsi untuk mendapatkan daftar trending
    public static function getTrending($timeWindow = 'day')
    {
        return cache()->remember("trending_movie_{$timeWindow}", now()->addDay(), function() use ($timeWindow) {
            return self::request("/trending/movie/day");
        });
    }

    public static function getMovieCredits($movieId){
        return cache()->remember("movie_credits_{$movieId}", now()->addDays(7), function() use ($movieId) {
            return self::request("/movie/{$movieId}/credits");
        });
    }

    public static function getMovieVideos($movieId){
        return cache()->remember("movie_videos_{$movieId}", now()->addDays(7), function() use ($movieId) {
            return self::request("/movie/{$movieId}/videos");
        });
    }



    public static function getTVShowCredits($tvId){
        return self::request("/tv/{$tvId}/credits");
    }

    public static function getMovieReviews($movieId){
        return cache()->remember("movie_reviews_{$movieId}", now()->addDays(7), function() use ($movieId) {
            return self::request("/movie/{$movieId}/reviews");
        });
    }

    public static function getTVShowReviews($tvId){
        return self::request("/tv/{$tvId}/reviews");
    }
}
