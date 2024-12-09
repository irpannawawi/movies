@php
    use App\Helpers\TMDBHelper;
@endphp
<div class="col-sm-4 col-md-2 mb-4 p-1">
    <div class="movie-card">
        <img src="{{ $image }}" alt="Movie Poster">
        <a href="{{ route('movies.show', ['id'=>$id, 'slug' => Str::slug($title)]) }}">
        <div class="overlay">
            <div class="movie-title">{{ $title }} ({{ Carbon\Carbon::parse($releaseDate)->format('Y') }})</div>
            <div class="movie-info d-flex justify-content-between">
                <span>Duration: {{ $runtime }} Min</span>
                <span>Rating: ⭐ {{ number_format($rating, 1, '.', '') }}</span>
            </div>
        </div>
    </a>

        <div class="badge-category">
            @php
                $genreList = collect(TMDBHelper::getMovieGenres());
            @endphp
            @foreach ($genres as $genre)
            <a href="{{ route('movies.category', ['id'=>$genre['id'], 'slug' => Str::slug(
            $genreList
            ->where('id', $genre['id'])
            ->first()['name']
            )]) }}">
                        <span class="badge badge-info">
                        {{ $genreList->where('id', $genre['id'])->first()['name'] }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</div>