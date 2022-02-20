@extends('layouts.app')

@section('content')
    <div class="row">
        <ul class="col-8 add-list">
            <li>
                <a href="{{ route('issues.create') }}">
                    Новий випуск
                </a>
            </li>
            <li>
                <a href="{{ route('states.create') }}">
                    Нова стаття
                </a>
            </li>
            <li>
                <a href="{{ route('media.create') }}">
                    Нове фото/відео
                </a>
            </li>
            <li>
                <a href="{{ route('headings.create') }}">
                    Нова рубрика
                </a>
            </li>
        </ul>
    </div>
@endsection
