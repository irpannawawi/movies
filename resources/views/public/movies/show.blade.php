@extends('layouts.main')
@php
    use App\Helpers\TMDBHelper;
@endphp
@section('content')
    <section class="breadcrumb-area breadcrumb-bg bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-3">
                        <img src="{{ TMDBHelper::getImage($movie['poster_path'], 500) }}" class="card-img-top"
                            alt="{{ $movie['title'] }}">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="breadcrumb-title">
                        <h1>{{ $movie['title'] }}<br><small>{{ $movie['tagline'] }}</small></h1>
                    </div>
                    <div class="banner-meta">
                        <ul>
                            <li class="quality">
                                @if ($movie['adult'])
                                    <span>18+</span>
                                @endif
                                <span>hd</span>
                            </li>
                            <li class="category">
                                @foreach ($movie['genres'] as $genre)
                                    <a
                                        href="{{ route('movies.category', ['id' => $genre['id'], 'slug' => Str::slug($genre['name'])]) }}">{{ $genre['name'] }}</a>,
                                @endforeach
                            </li>
                            <li class="release-time">
                                <span><i class="far fa-calendar-alt"></i>
                                    {{ Carbon\Carbon::parse($movie['release_date'])->format('Y') }}</span>
                                <span><i class="far fa-clock"></i> {{ $movie['runtime'] }} min</span>
                            </li>
                        </ul>
                    </div>
                    <p>
                        {{ $movie['overview'] }}
                    </p>
                    <div class="movie-details-prime">
                        <ul>
                            <li class="streaming">
                                <h6>Watch trailer</h6>
                                <span>{{ $movie['title'] }}</span>
                            </li>
                            <li class="watch"><a role="button" href="#watch"
                                    class="btn popup-video"><i class="fas fa-play"></i> Watch Now</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="movie-details-bg bg-dark pt-3 pb-3" id="watch">
        <div class="container">
            <div class="row">
                <div class="col-12 h-100">
                    <div class="movie-details-title text-center">
                        <h2>Nonton film {{ $movie['title'] }}
                            ({{ Carbon\Carbon::parse($movie['release_date'])->format('Y') }})</h2>
                    </div>
                </div>
                <div class="col-md-8 mx-auto" style="display: flex; justify-content: center;" >
                    <div class="movie-player" style="width: 100%; height: 500px;">

                        <iframe width="100%" height="100%" scrolling="no" src="https://vidsrc.icu/embed/movie/{{ $movie['imdb_id']}}" frameborder="0" allow="autoplay; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="movie-details-bg bg-dark pt-3 pb-3">
        <div class="container">
            <div class="card bg-dark">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="sinopsis-tab" data-toggle="tab" href="#sinopsis" role="tab"
                                aria-controls="sinopsis" aria-selected="true">Sinopsis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="clips-tab" data-toggle="tab" href="#clips" role="tab"
                                aria-controls="clips" aria-selected="false">Clips</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="cast-tab" data-toggle="tab" href="#cast" role="tab"
                                aria-controls="cast" aria-selected="false">Cast</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab"
                                aria-controls="reviews" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body text-white">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="sinopsis" role="tabpanel"
                            aria-labelledby="sinopsis-tab">
                            <p>
                                {{ $movie['overview'] }}
                            </p>
                        </div>
                        <div class="tab-pane fade" id="clips" role="tabpanel" aria-labelledby="clips-tab">
                            <ul class="clips-list">
                                @foreach ($videos['results'] as $video)
                                    @if ($video['site'] == 'YouTube' && $video['type'] == 'Trailer')
                                        <li class="clips-item p-2">
                                            <span>{{ $video['name'] }}</span>
                                            <a href="https://www.youtube.com/watch?v={{ $video['key'] }}" target="_blank"
                                                rel="nofollow noopener noreferrer">Watch Now</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="cast" role="tabpanel" aria-labelledby="cast-tab">
                            @php
                                $credit = TMDBHelper::getMovieCredits($movie['id']);
                            @endphp
                            <div class="row">
                                @foreach ($credit['cast'] as $cast)
                                    <div class="col-md-2">
                                            <img src="{{ TMDBHelper::getImage($cast['profile_path'], 200) }}"
                                                alt="{{ $cast['name'] }}">
                                            <h3>{{ $cast['name'] }}</h3>
                                            <span>{{ $cast['character'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <ul class="reviews-list">
                                @foreach ($reviews['results'] as $review)
                                    <li class="reviews-item d-flex p-2 border">
                                        <div class="reviews-item-img mr-3">
                                            <img src="{{ TMDBHelper::getImage($review['author_details']['avatar_path'], 200) }}"
                                                alt="{{ $review['author'] }}">
                                        </div>
                                        <div class="reviews-item-content">
                                            <h4>{{ $review['author'] }}</h4>
                                            <span>{{ $review['content'] }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
