@extends('layouts.app')



@section('content')
    <div class="row list">
        <div class="col-6 last-states issues-list">
            <ul>
                @foreach($headings as $heading)
                    <li>
                        <a href="{{ route('headings.show', ['heading' => $heading->id ]) }}" class="state-name">
                            {{ $heading->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
