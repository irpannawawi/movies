<!doctype html>
<html class="no-js" lang="">
@include('layouts.partials.head')

<body>

    @include('layouts.partials.preloader')

    @include('layouts.partials.header')


    <!-- main-area -->
    <main>

        @yield('content')



    </main>
    <!-- main-area-end -->


    @include('layouts.partials.footer')




    @include('layouts.partials.scripts')
</body>

</html>
