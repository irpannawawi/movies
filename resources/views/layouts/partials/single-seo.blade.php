<?php 
  use App\Helpers\TMDBHelper;
?>
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
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "{{route('movies.show', ['id' => $movie['id'], 'slug' => Str::slug($movie['title'])])}}"
    },
    "headline": "{{$movie['title']}}",
    "image": "{{ TMDBHelper::getImage($movie['poster_path'], 1280) }}",  
    "author": {
      "@type": "Person",
      "name": "Nadya",
      "url": "{{route('author')}}"
    },  
    "publisher": {
      "@type": "Organization",
      "name": "Inflix",
      "logo": {
        "@type": "ImageObject",
        "url": "{{env('APP_URL')}}/assets/theme/movfix/img/logo/logo.png"
      }
    },
    "datePublished": "{{str_replace(' ', 'T', $movie['created_at'])}}",
    "dateModified": "{{str_replace(' ', 'T', $movie['updated_at'])}}"
  }
  </script>

  <script type="application/ld+json">
    {
      "@context": "https://schema.org/", 
      "@type": "BreadcrumbList", 
      "itemListElement": [{
        "@type": "ListItem", 
        "position": 1, 
        "name": "home",
        "item": "{{route('home')}}"  
      },{
        "@type": "ListItem", 
        "position": 2, 
        "name": "articles",
        "item": "{{route('movies.show', ['id' => $movie['id'], 'slug' => Str::slug($movie['title'])])}}"  
      }]
    }
    </script>