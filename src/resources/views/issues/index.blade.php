@extends('layouts.app')

@section('content')
    <div class="row list">
        <div class="col-6 last-states issues-list">
            <ul>
                @foreach($issues as $issue)
                    <li>
                        <p class="date">
                            {{ \Carbon\Carbon::parse($issue->created_at)->format('d.m.Y') }}
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
