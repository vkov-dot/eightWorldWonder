@extends('layouts.app')



@section('content')
    <div class="row list">
        <div class="col-6 last-states issues-list">
            <ul>
                @foreach($headings as $heading)
                    <li>
                        <div class="heading-image">
                            <a href="{{ route('headings.show', ['heading' => $heading->id ]) }}">
                                <img src="{{ asset("storage/$heading->image") }}" alt="аватар">
                            </a>
                        </div>
                        <a href="{{ route('headings.show', ['heading' => $heading->id ]) }}" class="state-name">
                            {{ $heading->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
