@extends('layouts.app')

@section('content')
    <div class="div-add-list">
        <ul class="add-list row">
            <li class="col-xl-6 col-lg-12">
                <a href="{{ route('issues.create') }}">
                    ВИПУСК
                </a>
            </li>
            <li class="col-xl-6 col-lg-12">
                <a href="{{ route('states.create') }}">
                    СТАТТЯ
                </a>
            </li>
            <li class="col-xl-6 col-lg-12">
                <a href="{{ route('media.create') }}">
                    ПАПКА
                </a>
            </li>
            <li class="col-xl-6 col-lg-12">
                <a href="{{ route('headings.create') }}">
                    РУБРИКА
                </a>
            </li>
            <li class="col-xl-6 col-lg-12">
                <a href="{{ route('photos.create') }}">
                    ФОТО
                </a>
            </li>
            <li class="col-xl-6 col-lg-12">
                <a href="{{ route('videos.create') }}">
                    ВІДЕО
                </a>
            </li>
        </ul>
    </div>
@endsection
