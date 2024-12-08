@extends('layouts.main')
@php
    use App\Helpers\TMDBHelper;
@endphp
@section('content')
    <!-- up-coming-movie-area -->
    <section class="ucm-area ucm-bg">
        <div class="ucm-bg-shape"></div>
        <div class="container">
            <div class="row align-items-end mb-55">
                <div class="col-lg-6">
                    <div class="section-title text-center text-lg-left">
                        <h1 class="title">Hasil pencarian film {{ request()->query('s') }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($movies['results'] as $key => $mov)
                    @php
                        $movie = TMDBHelper::getMovieDetails($mov['id']);
                        if (!$movie['poster_path']) {
                            continue;
                        }
                    @endphp

                    <x-movie-card image="{{ TMDBHelper::getImage($movie['poster_path'], 200) }}"
                        title="{{ $movie['title'] }}"
                        releaseDate="{{ Carbon\Carbon::parse($movie['release_date'])->format('Y') }}"
                        rating="{{ $movie['vote_average'] }}" loading="{{ $key < 3 ? 'lazy' : 'eager' }}" :genres="$movie['genres']"
                        :id="$movie['id']"
                        runtime="{{ $movie['runtime'] }}" />
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="pagination-wrap mt-30">
                        <nav>
                            <ul>
                                @if ($movies['page'] > 3)
                                    <li><a
                                            href="{{ route('movies.search', ['s' => request()->query('s'), 'page' => 1]) }}">First</a>
                                    </li>
                                @endif
                                @if ($movies['page'] > 1)
                                    <li><a
                                            href="{{ route('movies.search', ['s' => request()->query('s'), 'page' => $movies['page'] - 1]) }}">Prev</a>
                                    </li>
                                @endif
                                @for ($i = max(1, $movies['page'] - 3); $i <= min($movies['page'] + 3, $movies['total_pages']); $i++)
                                    <li class="{{ $i == $movies['page'] ? 'active' : '' }}"><a
                                            href="{{ route('movies.search', ['s' => request()->query('s'), 'page' => $i]) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                @if ($movies['page'] < $movies['total_pages'])
                                    <li><a
                                            href="{{ route('movies.search', ['s' => request()->query('s'), 'page' => $movies['page'] + 1]) }}">Next</a>
                                    </li>
                                @endif
                                @if ($movies['page'] < $movies['total_pages'] - 3)
                                    <li><a
                                            href="{{ route('movies.search', ['s' => request()->query('s'), 'page' => $movies['total_pages']]) }}">Last</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- up-coming-movie-area-end -->
@endsection
