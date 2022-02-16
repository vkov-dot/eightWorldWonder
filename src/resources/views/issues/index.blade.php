@extends('layouts.app')

@section('content')
    <div class="col-4 last-states">
        <div class="last-states-title">
            <p>«Наші видання»</p>
        </div>
        <ul>
            @foreach($issues as $issue)
                <li>
                    <a href="{{ $issue->link }}" class="state-name">
                        {{ $issue->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
