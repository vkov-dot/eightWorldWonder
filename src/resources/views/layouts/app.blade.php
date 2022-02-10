<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Восьме диво світу</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-slogo.tifcreen dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="row">
        <div class="row">
            <div class="logo">
                <img src="{{ asset("img/logo.png") }}">
            </div>
            <div>
                <nav class="menu-list">
                    <div>
                        <ul>
                            <li><a href="{{ route('start.index') }}">Главная</a></li>
                            <li><a href="{{ route('issues.index') }}">Выпуски</a></li>
                            <li><a href="{{ route('media.index') }}">Фото/Видео</a></li>
                            <li><a href="{{ route('states.index') }}">Статьи</a></li>
                            <li><a href="{{ route('headings.index') }}">Рубрики</a></li>
                        </ul>
                    </div>
                    <div class="add-to-archive">
                        <button>Добавить</button>
                    </div>
                </nav>
            </div>
            <div class="col-4 last-states">
                <div class="last-states-title">
                    <p>Последние статьи</p>
                </div>
                <ul>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи вот так вот да такой вот длинный текст тут написан</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">У это статьи очень очень длинное название</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">У это статьи очень очень длинное название</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">У это статьи очень очень длинное название</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                    <li><p class="date">дд.мм.гггг</p><a href="#" class="state-name">Название статьи</a></li>
                </ul>
            </div>

            <section class="col-8 content">
                @yield('content')
            </section>
        </div>
    </div>
</div>
</body>
</html>
