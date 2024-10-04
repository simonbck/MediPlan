<html lang="{{ substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) }}">
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>{{ env('APP_NAME')  }}</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="bi bi-capsule-pill"></i>{{ env('APP_NAME')  }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="./">{{  __('header.overview') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('medicationplan') ? 'active' : '' }}" href="./medicationplan">{{  __('header.medicationplan') }}</a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('header.actions')  }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!--<li><a class="dropdown-item" href="#">Passwort ändern</a></li>
                            <li><hr class="dropdown-divider"></li>-->
                            <li>
                                <form action="/logout" method="POST" id="logout">
                                    @csrf
                                    <a class="dropdown-item" onclick="document.getElementById('logout').submit();">Logout</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container" id="app">
            <br>
            @yield('content')
        </div>
    </body>
</html>
