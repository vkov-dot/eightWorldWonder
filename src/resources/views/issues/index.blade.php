@extends('layouts.app')

@section('content')
    <div class="row list">
        <div class="col-6 last-states issues-list">
            <ul>
                @foreach($issues as $issue)
                    <li>
                        <p class="date">
                            {{ $issue->date }}
                        </p>
                        <a href="{{ $issue->link }}" class="state-name" target="_blank">
                            {{ $issue->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
