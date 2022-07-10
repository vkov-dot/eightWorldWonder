@extends('layouts.app')

@section('content')
    <div class="row state-show-main-div">
        <div class="col-xl-4">
            <last-states-list :states="{{ $lastStates }}" v-if="{{ $lastStates->count() }}"></last-states-list>
        </div>
        <router-view :state="{{ $state }}">

        </router-view>
    </div>


@endsection
