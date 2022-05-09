@extends('layouts.app')



@section('content')
    <div class="last-states issues-list col-lg-9 col-md-12   heading-show-list">
        @if($states->count())
            <div>
                <div class="notes-list-div states-list">
                    <div class="last-states-title heading-name-link">
                        <a href="{{ route('headings.index') }}">{{ $heading->name }}</a>
                    </div>
                    <ul>
                        @foreach($states as $state)
                            <li>
                                <p class="date">
                                    {{ \Carbon\Carbon::parse($state->created_at)->format('d.m.Y') }}
                                </p>
                                <a href="{{ route('states.show', ['state' => $state->id]) }}" class="state-name">
                                    {{ $state->name }}
                                </a>
                                <p class="state-author">{{ $state->author }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if($states->total() > $states->count())
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body pagination">
                                    {{ $states->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>

@endsection
