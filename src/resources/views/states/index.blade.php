@extends('layouts.app')



@section('content')
    <div class="row">
        <div class="last-states col-8 states">
            <div class="last-states-title">
                <p></p>
            </div>
            <ul>
                @foreach($states as $state)
                    <li>
                        <p class="date">
                            {{ $state->created_at }}
                        </p>
                        <a href="{{ route('states.show', ['state' => $state->id]) }}" class="state-name">
                            {{ $state->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
