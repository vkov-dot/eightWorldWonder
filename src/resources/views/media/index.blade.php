@extends('layouts.app')



@section('content')
    <div class="row list">
        <div class="col-10 last-states issues-list">
            <div class="col-12">
                @if($mediaFolders->count())
                    <div>
                        <div class="notes-list-div states-list">
                            <ul>
                                @foreach($mediaFolders as $folder)
                                    <li>
                                        <p class="date">
                                            {{  \Carbon\Carbon::parse($folder->created_at)->format('d.m.Y') }}
                                        </p>
                                        <a href="{{ route('media.show', ['media' => $folder->id ]) }}" class="state-name">
                                            {{ $folder->name }}
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
