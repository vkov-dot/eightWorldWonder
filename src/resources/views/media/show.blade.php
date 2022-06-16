@extends('layouts.app')



@section('content')
    <div class="row list">
        <div class="col-10 last-states issues-list">
            <div class="col-12">
                <div>
                    <div class="notes-list-div states-list">
                        <div class="last-states-title">
                            <p class="ml-1">
                                {{ $mediaFolder->name }}
                            </p>
                        </div>

                        @if($mediaFolder->photos->count())
                            <ul>
                                @foreach($mediaFolder->photos as $photo)
                                    <li>
                                        <p class="date">
                                            {{ \Carbon\Carbon::parse($photo->created_at)->format('d.m.Y') }}
                                        </p>
                                        <a href="{{ $photo->link }}" class="state-name" target="_blank">
                                            {{ $photo->name }}
                                        </a>
                                        @if(Auth::user() && Auth::user()->admin)
                                            <form action="{{ route('photos.destroy', ['photo' => $photo->id]) }}"
                                                  class="destroy-issue" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Видалити</button>
                                            </form>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        @if($mediaFolder->videos->count())
                            <ul>
                                @foreach($mediaFolder->videos as $video)
                                    <li>
                                        <p class="date">
                                            {{ \Carbon\Carbon::parse($video->created_at)->format('d.m.Y') }}
                                        </p>
                                        <a href="{{ $video->link }}" class="state-name" target="_blank">
                                            {{ $video->name }}
                                        </a>
                                        @if(Auth::user() && Auth::user()->admin)
                                            <form action="{{ route('videos.destroy', ['video' => $video->id]) }}"
                                                  class="destroy-issue" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    Видалити
                                                </button>
                                            </form>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    @if(Auth::user() && Auth::user()->admin)
                        <form action="{{ route('media.destroy', ['media' => $mediaFolder->id]) }}"
                              class="" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="destroy-submit">
                                Видалити
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
