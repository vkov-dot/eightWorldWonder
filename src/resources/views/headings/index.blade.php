@extends('layouts.app')



@section('content')
    <div class="col-4 last-states">
        <div class="last-states-title">
            <p>Последние статьи</p>
        </div>
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
@endsection
