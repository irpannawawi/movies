<head>
    {{-- preconnect --}}
    <link rel="preconnect" href="{{ env('APP_URL') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{-- preloader --}}
    <link rel="preload" as="style" href="{{ asset('assets/theme/movfix') }}/css/bootstrap.min.css">
    <link rel="preload" as="script" href="{{ asset('assets/theme/movfix') }}/js/vendor/jquery-3.6.0.min.js">
    <link rel="preload" as="image" href="{{ asset('assets/theme/movfix') }}/img/poster/ucm_poster01.jpg">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! seo($SEOData ?? null) !!}

    @if (request()->routeIs('home'))
        @include('layouts.partials.home-seo')
    @elseif (request()->routeIs('movies.show'))
        @include('layouts.partials.single-seo')
    @elseif (request()->routeIs('movies.category'))
        @include('layouts.partials.category-seo')
    @endif
    <!-- Place favicon.ico in the root directory -->
    @if (env('APP_ENV') == 'production')
        <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{env('GOOGLE_ANALYTICS_ID')}}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', "{{env('GOOGLE_ANALYTICS_ID')}}");
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    m[i].l=1*new Date();
    for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
    k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
 
    ym(99159818, "init", {
         clickmap:true,
         trackLinks:true,
         accurateTrackBounce:true,
         webvisor:true
    });
 </script>
 <noscript><div><img src="https://mc.yandex.ru/watch/99159818" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
 <!-- /Yandex.Metrika counter -->
    @endif

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/theme/movfix') }}/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="{{asset('assets/theme/movfix')}}/css/animate.min.css" defer> --}}
    <link rel="stylesheet" href="{{ asset('assets/theme/fontawesome/css/custom.css') }}" defer>
    {{-- <link rel="stylesheet" href="{{ asset('assets/theme/movfix') }}/css/owl.carousel.min.css" defer> --}}
    {{-- <link rel="stylesheet" href="{{asset('assets/theme/movfix')}}/css/flaticon.css" defer>
        <link rel="stylesheet" href="{{asset('assets/theme/movfix')}}/css/odometer.css" defer> --}}
    {{-- <link rel="stylesheet" href="{{asset('assets/theme/movfix')}}/css/aos.css" defer> --}}
    {{-- <link rel="stylesheet" href="{{asset('assets/theme/movfix')}}/css/slick.css" defer> --}}
    <link rel="stylesheet" href="{{ asset('assets/theme/movfix') }}/css/default.min.css" defer>
    <link rel="stylesheet" href="{{ asset('assets/theme/movfix') }}/css/style.min.css" defer>
    <link rel="stylesheet" href="{{ asset('assets/theme/movfix') }}/css/responsive.min.css" defer>

    <style>
        .movie-card {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .movie-card img {
            width: 100%;
            height: auto;
        }

        .movie-card .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            text-align: left;
        }

        .movie-title {
            font-size: 0.9rem;
            font-weight: bold;
        }

        .movie-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.7rem;
        }

        .movie-card .badge-category {
            position: absolute;
            top: 10px;
            left: 10px;
            /* Yellow with opacity */
            color: black;
            font-size: 0.9rem;
            font-weight: bold;
            border-radius: 5px;
            padding: 5px;
        }

        @media (max-width: 767px) {
            .movie-card .badge-category {
                font-size: 0.7rem;
                padding: 3px;
            }
        }
    </style>


</head>
