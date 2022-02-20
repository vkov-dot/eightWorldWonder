@extends('layouts.app')



@section('content')
    <div class="col-4 last-states">
        <div class="last-states-title">
            <a href="{{ route('headings.index') }}">«{{ $heading->name }}»</a>
        </div>

        <ul>
            @foreach($states as $state)
                <li>
                    <a href="{{ route('states.show', ['state' => $state->id ]) }}" class="state-name">
                        {{ $state->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
