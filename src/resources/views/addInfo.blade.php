@extends('layouts.app')

@section('content')
    <div class="row div-add-list">
        <ul class="col-6 add-list row">
            <li class="col-6">
                <a href="{{ route('issues.create') }}">
                    ВИПУСК
                </a>
            </li>
            <li class="col-6">
                <a href="{{ route('states.create') }}">
                    СТАТТЯ
                </a>
            </li>
            <li class="col-6">
                <a href="{{ route('media.create') }}">
                    ФОТО/ВІДЕО
                </a>
            </li>
            <li class="col-6">
                <a href="{{ route('headings.create') }}">
                    РУБРИКА
                </a>
            </li>
        </ul>
    </div>
@endsection
