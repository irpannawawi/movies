    @php
        use App\Helpers\TMDBHelper;
        
        @endphp
    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->
    <!-- header-area -->
    <header>
        <div id="sticky-header" class="menu-area transparent-header">
            <div class="container custom-container">
                <div class="row">
                    <div class="col-12">
                        <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                        <div class="menu-wrap">
                            <nav class="menu-nav show">
                                <div class="logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('assets/theme/movfix') }}/img/logo/logo.png" alt="Logo">
                                    </a>
                                </div>
                                <div class="navbar-wrap main-menu d-none d-lg-flex">
                                    <ul class="navigation">
                                        <li class="{{ request()->is('/') ? 'active' : '' }} menu-item"><a
                                                href="{{ route('home') }}">Home</a>
                                        </li>
                                        <li class="menu-item-has-children"><a role="button" href="#">Movie</a>
                                            <div class="submenu">
                                                <div class="row">
                                                    @foreach (TMDBHelper::getMovieGenres() as $genre)
                                                    <div class="col-4">
                                                        <a class="nav-link text-capitalize text-white" href="{{ route('movies.category', ['id'=>$genre['id'], 'slug' => Str::slug($genre['name'])]) }}">{{ $genre['name'] }}</a>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>

                                        
                                        {{-- <li class="menu-item-has-children"><a role="button" href="#">Tv Show</a>
                                            <div class="submenu">
                                                <div class="row">
                                                    @foreach (TMDBHelper::getTvGenres() as $genre)
                                                    <div class="col-4">
                                                        <a class="nav-link text-capitalize text-white" href="{{ route('tv-show.index', ['id'=>$genre['id'], 'slug' => Str::slug($genre['name'])]) }}">{{ $genre['name'] }}</a>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="header-action mr-3 d-md-block">
                                    <ul>
                                        <li class="header-search"><a href="#" data-toggle="modal"
                                                data-target="#search-modal"><i class="fas fa-search"></i></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <!-- Mobile Menu  -->
                        <div class="mobile-menu">
                            <div class="close-btn"><i class="fas fa-times"></i></div>

                            <nav class="menu-box">
                                <div class="nav-logo"><a href="index.html"><img
                                            src="{{ asset('assets/theme/movfix') }}/img/logo/logo.png" alt=""
                                            title=""></a>
                                </div>
                                <div class="menu-outer">
                                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                                </div>
                                <div class="social-links">
                                    <ul class="clearfix">
                                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                        <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                        <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                        <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                        <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="menu-backdrop"></div>
                        <!-- End Mobile Menu -->

                        <!-- Modal Search -->
                        <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('movies.search') }}" method="get">
                                        <input type="text" placeholder="Search here..." name="s">
                                        <button><i class="fas fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Search-end -->

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area-end -->
