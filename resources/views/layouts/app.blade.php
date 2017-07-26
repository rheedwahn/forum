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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/noty.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('summernote/summernote.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/atom-one-dark.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile') }}">
                                            Profile
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container">
            <div class="row">
                
                <div class="col-md-4">
                    <a href="{{ route('discussions.create') }}" class="btn btn-primary">Create Discussion</a>
                    <p></br></p>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Menu
                        </div>
                        <div class="panel-body">
                            <form class="form-inline" method="get" action="{{ route('search.result') }}">
                                <div class="form-group">
                                    <label class="sr-only" for="search">Search by Title</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="search" id="search" placeholder="Search by Title">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default">Search</button>
                            </form>
                            </br>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="{{ route('forum') }}">Home</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="/forum?filter=me">My Discussions</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="/forum?filter=solved">Answered Discussions</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="/forum?filter=unsolved">Unanswered Discussions</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('leadership.board') }}">Leadership Board</a>
                                </li>
                                @if(Auth::check())
                                    @if(Auth::user()->admin)
                                        <li class="list-group-item">
                                            <a href="{{ route('channels.index') }}">Channels Settings</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                            <p>Channels</p><hr>
                            @if($channels->count() === 0)
                                <p class="text-center">No Channels available yet</p>
                            @else
                                <ul class="list-group">
                                    @foreach($channels as $channel)
                                        <li class="list-group-item">
                                            <a href="{{ route('channel', ['slug' => $channel->slug]) }}" style="text-decoration: none">{{ $channel->title }} <span class="badge">{{ count($channel->discussions) }}</span></a>
                                        </li>
                                    @endforeach()
                                </ul>
                            @endif
                        </div>
                        
                    </div>
                </div>
                
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
        </div>
       
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/matchheight.js') }}"></script>
    <script src="{{ asset('js/noty.js') }}"></script>
    <script src="{{ asset('js/bounce.js') }}"></script>
    <script type="text/javascript" src="{{ asset('summernote/summernote.js') }}"></script>
    <script>
		$(document).ready(function() {
		  $('#content').summernote();
		});
	</script>

    <script>
         $(document).ready(function() {
            $('.equal-height-panels .panel').matchHeight();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    @include('includes.noty')
</body>
</html>
