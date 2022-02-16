@extends('layouts.app')



@section('content')
    <div class="col-4 last-states">
        <div class="last-states-title">
            <p>«{{ $heading->name }}»   </p>
        </div>
        <ul>
            @foreach($issues as $issue)
                <li>
                    <a href="{{ route('issues.show', ['issue' => $issue->id ]) }}" class="state-name">
                        {{ $issue->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
