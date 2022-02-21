@extends('layouts.app')



@section('content')
    <div class="row list">
        <div class="col-6 last-states issues-list">
            <ul>
                @foreach($states as $state)
                    <li>
                        <p class="date">
                            {{ $state->date }}
                        </p>
                        <a href="{{ route('states.show', ['state' => $state->id]) }}" class="state-name">
                            {{ $state->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
