@extends('layouts.app')



@section('content')
    <div class="row">
        <div class="col-6 last-states">
            <div class="last-states-title">
                <p>Скарбничка спогадів</p>
            </div>
            <ul>
                @foreach($mediaFolders as $folder)
                    <li>
                        <p class="date">
                            {{ $folder->created_at }}
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
