@extends('layouts.app')



@section('content')
    <div class="row list">
        <div class="col-6 last-states issues-list">
            <ul>
                @foreach($mediaFolders as $folder)
                    <li>
                        <p class="date">
                            {{ $folder->date }}
                        </p>
                        <a href="{{ route('media.show', ['media' => $folder->id ]) }}" class="state-name">
                            {{ $folder->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
