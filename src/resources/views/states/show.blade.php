@extends('layouts.app')



@section('content')
    <div class="row state-show-main-div">
        <div class="last-states col-10 states state-show-div">
            <div>
                <img src="{{ asset("storage/".$state->logo) }}" class="d-block w-100" alt="...">
                <p class="state-show-name">{{ $state->title }}</p>
                <p>{!! $state->body !!}</p>
                <p class="state-show-author">{{ $state->author }}</p>
                <form action="{{ route('states.destroy', ['state' => $state->id]) }}" class="destroy-state" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Удалить</button>
                </form>

            </div>
        </div>
    </div>

@endsection
