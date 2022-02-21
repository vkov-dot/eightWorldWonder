@extends('layouts.app')



@section('content')

    <div class="row list">
        <div class="last-states-title">
            <a href="{{ route('media.index') }}">{{ $mediaFolder->name }}</a>
        </div>
        <div class="col-6 last-states issues-list">
            <ul>
                @foreach($medias as $media)
                    <li>
                        <p class="date">
                            {{ $media->date }}
                        </p>
                        <a href="{{ route('media.show', ['media' => $media->id ]) }}" class="state-name">
                            {{ $media->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
