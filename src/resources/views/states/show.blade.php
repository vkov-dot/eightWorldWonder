@extends('layouts.app')



@section('content')
    <div class="row state-show-main-div">
        <div class="col-xl-5 col-lg-12 last-states">
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

        <div class="last-states col-xl-7 col-lg-12 states state-show-div">
            <div>
                <p class="state-show-name">
                    {{ $state->name }}
                </p>
                <img src="{{ asset("storage/".$state->logo) }}" class="d-block w-100" alt="Нажаль даного зображення немає :(">
                <p>
                    {!! $state->body !!}
                </p>
                <p class="state-show-author">
                    {{ $state->author }}
                </p>
                @if(Auth::user() && Auth::user()->admin)
                <div class="state-show-redact-destroy">
                    <div class="redact-state-link">
                        <a href="{{ route("states.edit", ['state' => $state->id]) }}">
                            Редактировать
                        </a>
                    </div>
                    <form action="{{ route('states.destroy', ['id' => $state->id]) }}" class="destroy-state" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            До архіва
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection
