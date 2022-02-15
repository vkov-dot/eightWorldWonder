@extends('layouts.app')



@section('content')
    <div class="row">
        <div class="last-states col-8 states">
            <div class="last-states-title">
                <p>{{ $state->title }}</p>
                <p>{{ $state->body }}</p>
            </div>

        </div>
    </div>

@endsection
