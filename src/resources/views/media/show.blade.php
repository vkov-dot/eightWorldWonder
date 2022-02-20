@extends('layouts.app')



@section('content')
    <div class="col-4 last-states">
        <div class="last-states-title">
            <a href="{{ route('media.index') }}">{{ $mediaFolder->name }}</a>
        </div>
        <ul>
            @foreach($media as $media)
                <li>
                    <a href="{{ route('media.show', ['media' => $media->id ]) }}" class="state-name">
                        {{ $media->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
