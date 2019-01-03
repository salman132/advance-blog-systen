<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/styles/atom-one-dark.min.css">


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
            <div class="container">
                <div class="row">

                    <div class="col-md-4">
                        @if(Auth::check())
                        <a href="{{route('discussion.create')}}" class="form-control btn btn-primary">Create New Discussion</a>
                        @endif


                        <div class="py-5">
                            <div class="card">
                                <div class="card-header">
                                    <h4>My Navigation</h4>
                                </div>
                                <div class="card-body">
                                   @if(Auth::check())


                                        @if(Auth::user()->admin)

                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <a href="/channels">All Channels</a>
                                                </li>
                                            </ul>


                                        @endif

                                       @endif
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <a href="/forum">Home</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/forum/?filter=me">My Discussions</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/forum/?filter=solved">Solved Questions</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/forum/?filter=pending">Pending Questions</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Channels
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">


                                        @foreach($channels as $channel)

                                            <li class="list-group-item">

                                                <a href="{{route('channel',['slug'=>$channel->slug])}}">{{$channel->title}}</a>
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        @if($errors->count()>0)


                            <ul class="list-group">
                                @foreach($errors->all() as $error)

                                    <li class="list-group-item">
                                        <div class="text-danger">
                                            {{$error}}
                                        </div>
                                    </li>

                                    @endforeach
                            </ul>

                            @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <script>
        @if(Session::has('success'))


            toastr.success('{{Session::get('success')}} ')

            @endif
    </script>
</body>
</html>
