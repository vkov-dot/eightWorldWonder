@extends('layouts.app')



@section('content')
    <div class="row state-show-main-div">
        <div class="last-states col-10 states state-show-div">
            <div class="last-states-title ">
                <img src="{{ asset("storage/".$state->logo) }}" class="d-block w-100" alt="...">
                <p>{{ $state->title }}</p>
                <p>{!! $state->body !!}</p>
                <p>{{ $state->author }}</p>
            </div>
        </div>
    </div>

@endsection
