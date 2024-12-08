@extends('layouts.main')
@php
    use App\Helpers\TMDBHelper;
@endphp
@section('content')
    <section class="breadcrumb-area breadcrumb-bg" style="background-color:black;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h1 class="title">Tonton Film & Acara TV Tanpa Batas | Streaming Konten HD hanya di
                            {{ env('APP_NAME') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row p-0 bg-dark">
                <div class="col-12 text-center text-white mt-4 mb-2">
                    <h2 class="">Sedang tayang</h2>
                </div>
                @foreach ($nowPlayingMovies['results'] as $key => $mov)
                    @php
                        $movie = TMDBHelper::getMovieDetails($mov['id']);
                    @endphp
                    <x-movie-card 
                    :id="$movie['id']"
                    image="{{ TMDBHelper::getImage($movie['poster_path'], 500) }}" title="{{ $movie['title'] }}"
                    releaseDate="{{ Carbon\Carbon::parse($movie['release_date'])->format('Y') }}"
                    rating="{{ $movie['vote_average'] }}" 
                    loading="{{ $key < 3 ? 'lazy' : 'eager' }}"
                    :genres="$movie['genres']" 
                    runtime="{{ $movie['runtime'] }}" />
                @endforeach
            </div>
        </div>
    </section>


    <!-- top-rated-movie -->
    <section class="top-rated-movie tr-movie-bg" style="background-color: #000">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center mb-50">
                        <h2 class="title">Trending Film</h2>
                    </div>
                </div>
            </div>
            <div class="row d-flex">
                @foreach (collect($trendingMovies['results']) as $key => $mov)
                    @php
                        $movie = TMDBHelper::getMovieDetails($mov['id']);
                    @endphp
                    <x-movie-card :id="$movie['id']" image="{{ TMDBHelper::getImage($movie['poster_path'], 200) }}"
                        title="{{ $movie['title'] }}"
                        releaseDate="{{ Carbon\Carbon::parse($movie['release_date'])->format('Y') }}"
                        rating="{{ $movie['vote_average'] }}" loading="{{ $key < 3 ? 'lazy' : 'eager' }}"
                        :genres="$movie['genres']" runtime="{{ $movie['runtime'] }}" />
                @endforeach
            </div>
        </div>
    </section>
    <!-- top-rated-movie-end -->
@endsection
