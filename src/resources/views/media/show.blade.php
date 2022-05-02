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
                            {{ \Carbon\Carbon::parse($media->created_at)->format('d.m.Y') }}
                        </p>
                        <a href="{{ $media->link }}" class="state-name">
                            {{ $media->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
