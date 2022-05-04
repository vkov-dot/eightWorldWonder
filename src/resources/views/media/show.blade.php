@extends('layouts.app')



@section('content')
    <div class="row list">
        <div class="col-10 last-states issues-list">
            <div class="col-12">
                @if($medias->count())
                    <div>
                        <div class="notes-list-div states-list">
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
                @endif
            </div>
        </div>
    </div>

@endsection
