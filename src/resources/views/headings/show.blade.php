@extends('layouts.app')



@section('content')
    <div class="last-states issues-list col-lg-9 col-md-12   heading-show-list">
            <div>
                <div class="notes-list-div states-list">
                    <div class="last-states-title heading-name-link">
                        <a href="{{ route('headings.index') }}">{{ $heading->name }}</a>
                    </div>
                    @if($heading->states->count())

                    <ul>
                        @foreach($heading->states as $state)
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
                    @endif
                </div>
                @if(Auth::user() && Auth::user()->admin)
                    <form action="{{ route('headings.edit', ['heading' => $heading->id]) }}"
                          class="">
                        @csrf
                        <button type="submit" class="btn btn-primary">Редагувати</button>
                    </form>
                @endif
                @if($heading->states->total() > $heading->states->count())
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
    </div>

@endsection
