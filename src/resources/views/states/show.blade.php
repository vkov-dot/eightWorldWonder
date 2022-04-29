@extends('layouts.app')



@section('content')
    <div class="row state-show-main-div">
        <div class="col-4 last-states">
            <div class="last-states-title">
                <p>Останні статті</p>
            </div>
            <ul class="states-list">
                @foreach($lastStates as $states)
                    <li>
                        <p class="date">
                            {{ \Carbon\Carbon::parse($states->created_at)->format('d.m.Y') }}
                        </p>
                        <a href="{{ route('states.show', ['state' => $states->id ]) }}" class="state-name">
                            {{ $states->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="last-states col-7 states state-show-div">
            <div>
                <p class="state-show-name">
                    {{ $state->name }}
                </p>
                <img src="{{ asset("storage/".$state->logo) }}" class="d-block w-100" alt="...">
                <p>
                    {!! $state->body !!}
                </p>
                <p class="state-show-author">
                    {{ $state->author }}
                </p>
                <div class="redact-state-link">
                    <a href="{{ route("states.edit", ['state' => $state->id]) }}">
                        Редактировать
                    </a>
                </div>
                <form action="{{ route('states.destroy', ['state' => $state->id]) }}" class="destroy-state" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        Удалить
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
