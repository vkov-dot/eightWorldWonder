<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Восьме диво світу</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="antialiased">
<header>
    <div class="logo">
        <img src="{{ asset("img/logo.png") }}">
    </div>
    <div>
        <nav class="menu-list">
            <div>
                <ul>
                    <li>
                        <a id="{{ (request()->route()->getName() === 'start.index') ? 'active-url' : '' }}"
                           href="{{ route('start.index') }}">
                            Головна
                        </a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                               id="{{ (request()->route()->getName() === 'issues.index') ? 'dropdownMenuLink' : '' }}"
                               href="{{ route('issues.index') }}" role="button">
                                Газета
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" value="1"
                                       href="{{ route('categories.show', ['category' => 1]) }}">
                                        Випуски
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" value="2"
                                       href="{{ route('categories.show', ['category' => 2]) }}">
                                        Біблія
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" value="3"
                                       href="{{ route('categories.show', ['category' => 3]) }}">
                                        День народження
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </li>
                    <li>
                        <a id="{{ (request()->route()->getName() === 'media.index') ? 'active-url' : '' }}"
                           href="{{ route('media.index') }}">
                            Фото/Відео
                        </a>
                    </li>
                    <li>
                        <a id="{{ (request()->route()->getName() === 'states.index') ? 'active-url' : '' }}"
                           href="{{ route('states.index') }}">
                            Статті
                        </a>
                    </li>
                    <li>
                        <a id="{{ (request()->route()->getName() === 'headings.index') ? 'active-url' : '' }}"
                           href="{{ route('headings.index') }}">
                            Рубрики
                        </a>
                    </li>
                </ul>
            </div>
            <nav class="navbar navbar-expand-lg" id="navbar">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content"
                        aria-controls="navbar-content" aria-expanded="false" aria-label="toggle-navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-content">
                    <ul class="navbar-nav">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('login')) ? 'active-url' : '' }}"
                                   href="{{ route('login') }}">Увійти</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('register')) ? 'active-url' : '' }}"
                                   href="{{ route('register') }}">Реєстрація</a>
                            </li>

                        @else
                            <div id="add-to-archive dropdown">
                                <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                                   id="{{ (request()->route()->getName() === 'issues.index') ? 'dropdownMenuLink' : '' }}"
                                    role="button">
                                    Архів
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('archives.show', ['table' => 'states']) }}">
                                            Статті
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('archives.show', ['table' => 'issues']) }}">
                                            Газета
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div id="add-to-archive">
                                <a href="{{ route('addInfo') }}">Опублікувати</a>
                            </div>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Вийти
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </nav>
    </div>
</header>

<main
    class="relative col-11 flex items-top justify-center min-h-slogo.tifcreen dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="row">
        <section>
            @yield('content')
        </section>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
</body>
</html>
