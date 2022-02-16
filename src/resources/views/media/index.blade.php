@extends('layouts.app')



@section('content')
    <div class="col-4 last-states">
        <div class="last-states-title">
            <p>Скарбничка спогадів</p>
        </div>
        <ul>
            @foreach($photos as $photo)
                <li>
                    <a href="{{ route('media.show', ['media' => $photo->id ]) }}" class="state-name">
                        {{ $photo->name }}
                    </a>
                </li>
            @endforeach
        </ul>
        <ul>
            @foreach($videos as $video)
                <li>
                    <a href="{{ route('media.show', ['media' => $video->id ]) }}" class="state-name">
                        {{ $video->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
