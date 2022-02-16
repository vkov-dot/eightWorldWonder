@extends('layouts.app')



@section('content')
    <div class="col-4 last-states">
        <div class="last-states-title">
            <p>Скарбничка спогадів</p>
        </div>
        <ul>
            @foreach($mediaFolders as $folder)
                <li>
                    <a href="{{ route('media.show', ['media' => $folder->id ]) }}" class="state-name">
                        {{ $folder->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
