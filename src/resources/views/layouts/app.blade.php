<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Восьме диво світу</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="antialiased">

<header>
    <div class="logo">
        <img src="{{ asset("img/logo.png") }}">
    </div>
    <nav class="navbar navbar-expand-lg menu-list" id="navbar">
        <div>
            <ul class="menu-list-ul">
                <li>
                    <a class="menu-list-link" href="{{ route('start.index') }}"
                       id="{{ (request()->route()->getName() === 'start.index') ? 'active-url' : '' }}">
                        Головна
                    </a>
                </li>
                <div id="add-to-archive dropdown">
                    <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown" aria-expanded="false"
                       id="{{ (request()->route()->getName() === 'categories.show') ? 'dropdownMenuLink' : '' }}">
                        Газета
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="{{ route('issues.index') }}">
                                Усе
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('categories.show', ['category' => 1]) }}">
                                Випуски
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('categories.show', ['category' => 2]) }}">
                                Біблія
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('categories.show', ['category' => 3]) }}">
                                День народження
                            </a>
                        </li>
                    </ul>
                </div>
                <li>
                    <a class="menu-list-link" href="{{ route('media.index') }}"
                       id="{{ (request()->route()->getName() === 'media.index') ? 'active-url' : '' }}">
                        Фото/Відео
                    </a>
                </li>
                <li>
                    <a class="menu-list-link" href="{{ route('states.index') }}"
                       id="{{ (request()->route()->getName() === 'states.index') ? 'active-url' : '' }}">
                        Статті
                    </a>
                </li>
                <li>
                    <a class="menu-list-link" href="{{ route('headings.index') }}"
                       id="{{ (request()->route()->getName() === 'headings.index') ? 'active-url' : '' }}">
                        Рубрики
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content"
                    aria-controls="navbar-content" aria-expanded="false" aria-label="toggle-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-content">
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="menu-list-link {{ (request()->is('login')) ? 'active-url' : '' }}"
                               href="{{ route('login') }}">Увійти</a>
                        </li>
                        <li class="nav-item">
                            <a class="menu-list-link {{ (request()->is('register')) ? 'active-url' : '' }}"
                               href="{{ route('register') }}">Реєстрація</a>
                        </li>
                    @else
                        <div id="add-to-archive dropdown">
                            <a class="dropdown-toggle menu-list-link" data-bs-toggle="dropdown" aria-expanded="false"
                               id="{{ (request()->route()->getName() === 'archives.show') ? 'dropdownMenuLink' : '' }}">
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
                            <a class="menu-list-link" href="{{ route('addInfo') }}">Опублікувати</a>
                        </div>
                        <li class="nav-item">
                            <a class="menu-list-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Вийти
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
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
