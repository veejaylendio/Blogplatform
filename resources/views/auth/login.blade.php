<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('loginAssets/style.css') }}">
    
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> -->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <!-- @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest -->
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            <div class="materialContainer">


            <div class="box">
                    

                <div class="title">LOGIN</div>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('email2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('password2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        
                        <div class="input">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                            <span class="spin"></span>

                            <!-- @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror -->
                        </div>

                        <div class="input">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <span class="spin"></span>
                            <!-- @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror -->
                        </div>

                        <div class="button login">
                            <button type="submit"><span>GO</span> <i class="fa fa-check"></i></button>
                        </div>

                        <a href="{{ route('password.request') }}" class="pass-forgot">Forgot your password?</a>
                    </form>
            </div>

            <div class="overbox">
                <div class="material-button alt-2"><span class="shape"></span></div>

                <div class="title">{{ __('Register') }}</div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input">
                            <label for="name">{{ __('Name') }}</label>
                            <input  id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required autocomplete="name" autofocus>
                            <span class="spin"></span>
                            <!-- @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror -->
                        </div>

                        <div class="input">
                            <label for="email2">{{ __('Email Address') }}</label>
                            <input id="email2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                            <span class="spin"></span>

                            <!-- @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror -->
                        </div>

                        <div class="input">
                            <label for="password2">{{ __('Password') }}</label>
                            <input id="password2" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <span class="spin"></span>

                            <!-- @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror -->
                        </div>

                        <div class="input">
                            <label for="password-confirm">{{ __('Confirm Password') }} </label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <span class="spin"></span>
                        </div>

                        
                        <div class="button">
                            <button><span>NEXT</span></button>
                        </div>

                    </form>


            </div>

            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('loginAssets/login.js') }}"></script>
    
</body>
</html>
