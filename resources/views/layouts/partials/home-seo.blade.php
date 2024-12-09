@php
use Illuminate\Support\Str;
use App\Helpers\TMDBHelper;
    $SEOMovieCarousel = [];
    foreach ($nowPlayingMovies['results'] as $key => $mov) {
        $SEOMovieCarousel[] = [
            '@type' => 'ListItem',
            'position' => $key + 1,
            'item' => [
                '@type' => 'Movie',
                'url' => route('movies.show', ['id' => $mov['id'], 'slug' => Str::slug($mov['title'])]),
                'name' => $mov['title'],
                'image' => TMDBHelper::getImage($mov['poster_path'], 1280),
                'dateCreated' => $mov['release_date'],
                'aggregateRating' => [
                    '@type' => 'AggregateRating',
                    'ratingValue' => $mov['vote_average'],
                    'ratingCount' => $mov['vote_count'],
                    'bestRating' => $mov['vote_average'],
                ],
            ],
        ];
    }
@endphp
<script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "WebSite",
      "name": "Inflix",
      "url": "url",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "{{env('APP_URL')}}/search?s={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
</script>
<script type="application/ld+json">
    {
      "@context":"https://schema.org",
      "@type":"ItemList",
      "itemListElement":[
        {!!json_encode($SEOMovieCarousel,  JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT)!!}
      ]
    }
    </script>
