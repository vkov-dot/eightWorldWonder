@extends('layouts.app')



@section('content')
    <div class="row list">
        <div class="col-6 last-states issues-list">
            <div>
                <form method="post" enctype="multipart/form-data" action="{{ route('states.search') }}">
                    @csrf
                    <input type="text" name="param">
                    <input type="submit">
                </form>
            </div>
            <ul>
                @foreach($states as $state)
                    <li>
                        <p class="date">
                            {{ \Carbon\Carbon::parse($state->created_at)->format('d.m.Y') }}
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
