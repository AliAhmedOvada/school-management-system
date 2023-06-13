<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-2" style="    background-color: whitesmoke; height: 720px;">
                    <div class="sidebar " style="text-align: center;">
                        <ul class="nav flex-column"
                            style=" background-color: #67959b;;
                                    color: white;margin-top: 57px;
                                    width: 253px;
                                    margin-left: -12px;
                                    height: 720px;
                                    margin-top:0px;
                            ">
                            <!-- Admin Link -->
                            @if (Auth::check() && auth()->user()->role_id == 1)
                                <li class="nav-item">
                                    <a class="nav-link" style="color: azure;" href="{{ route('home') }}">Admin
                                        Dashboard</a>
                                </li>
                                <hr style="color: white;">
                                <li class="nav-item">
                                    <a class="nav-link" style="color: azure;"
                                        href="{{ route('classes.index') }}">Classes</a>
                                </li>
                                <hr style="color: white;">
                                <li class="nav-item">
                                    <a class="nav-link" style="color: azure;"
                                        href="{{ route('students.index') }}">Students</a>
                                </li>
                                {{-- <hr style="color: white;">
                                <li class="nav-item">
                                    <a class="nav-link" style="color: azure;"
                                        href="{{ route('subjects.index') }}">Subjects</a>
                                </li> --}}
                            @endif

                            <!-- Teacher Link -->
                            @if (Auth::check() && auth()->user()->role_id == 2)
                                <li class="nav-item">
                                    <a class="nav-link" style="color: azure;"
                                        href="{{ route('classes.index') }}"> <i class='fas fa-book-open' style='font-size:13px'></i> Classes</a>
                                </li>
                                <hr style="color: white;">
                                <li class="nav-item">
                                    <a class="nav-link" style="color: azure;"
                                        href="{{ route('students.index') }}"><i class='fas fa-user-graduate' style='font-size:13px'></i>  Students</a>
                                </li>
                                {{-- <hr style="color: white;">
                                <li class="nav-item">
                                    <a class="nav-link" style="color: azure;"
                                        href="{{ route('subjects.index') }}"><i class='fas fa-book-reader' style='font-size:13px'></i> Subjects</a>
                                </li> --}}
                                <hr style="color: white;">
                                <li class="nav-item">
                                    <a class="nav-link" style="color: azure;"
                                        href="{{ route('lectures.index') }}"><i class='fas fa-chalkboard-teacher' style='font-size:13px'></i>  Lectures</a>
                                </li>
                            @endif

                            <!-- Student Link -->
                            @if (Auth::check() && auth()->user()->role_id == 3)
                                <li class="nav-item">
                                    <a class="nav-link" style="color: azure;" href="{{ route('student-lms') }}">Student
                                        Lms</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-10">
                    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                        <div class="container">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ms-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif

                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
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
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>
