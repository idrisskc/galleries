<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/all.css') }}" rel="stylesheet">--}}

</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">

            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{--{{ config('app.name', 'Laravel') }}--}}
                    <img src="{{asset('img/logo.png')}}" alt=""> Gallery
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto justify-content-center">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <li><a class="nav-link" href="{{ url('/') }}">Home</a></li>



                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else

                            <div class="mobile-user-menu">
                            
                                 <li><a class="nav-link" href="{{url('/users/' . Auth::id() )}}">
                                    Profile
                                </a></li>
                                 <li><a class="nav-link" href="{{url('/users/' . Auth::id() . '/images' )}}">
                                    Images
                                </a></li>
                                 <li><a class="nav-link" href="{{url('/users/' . Auth::id() . '/albums' )}}">
                                    Albums
                                </a></li>

                                <li><a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    Logout
                                </a></li>

                            </div>

                            <li><a href="{{url('/users/' . Auth::user()->id . '/images/upload')}}"  class="btn btn-success btn-sm add-img-btn" href="">Add Photos</a></li>
                            <li><a href="{{url('/users/' . Auth::user()->id . '/albums/create')}}"  class="btn btn-secondary btn-sm add-album-btn" href="">Add an Album</a></li>

                            <div class="pull-left desktop-user-menu" style="margin-top: 6px; margin-right: 5px;">
                                <a href="{{ url('/users/' . Auth::id() )}}">
                                    <img alt="Profil" title="Profil" style="padding:1px; width:32px; height: 32px; border-radius: 50px; margin-left:5px;" class="img-responsive img-circle img-thumbnail" src="http://voice4thought.org/wp-content/uploads/2016/08/default2-1.jpg" alt="">
                                </a>
                            </div>


                            <li class="dropdown pull-right desktop-user-menu">
                                <a href="#" class="dropdown-toggle mt-4" style="    margin-top: 7px !important; position: absolute;" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{url('/users/' . Auth::id() )}}">
                                        {{Auth::user()->name}}
                                    </a>
                                    <a class="dropdown-item" href="{{url('/users/' . Auth::id() . '/images' )}}">
                                        Photos
                                    </a>
                                    <a class="dropdown-item" href="{{url('/users/' . Auth::id() . '/albums' )}}">
                                        Albums
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container mb-5">
                <div class="col-md-10 offset-md-1">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- JQuery -->
    {{--<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>--}}
    <!-- Bootstrap tooltips -->
    {{--<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>--}}
    <!-- Bootstrap core JavaScript -->
    {{--<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>--}}
    <!-- MDB core JavaScript -->
    {{--<script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>--}}
    <!-- FontAwesome -->
    {{--<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>--}}
    <!-- LightGallery -->
    {{--<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/lightgallery/lightgallery.js') }}"></script>--}}


</body>
</html>
