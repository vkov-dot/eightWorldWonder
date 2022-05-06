@extends('layouts.app')

@section('content')
    <div class="last-states issues-list">
        <form method="post" enctype="multipart/form-data" action="{{ route('states.search') }}"
              class="search-issue-form">
            @csrf
            <div class="form-group col-12 search-issue-select states-search-div">
                <div class="search-issue-select-first-d">
                    <label for="category" class="states-search-label">
                        <p>Шукати за</p>
                        <select class="form-control" id="search" name="message">
                            <option value="author">автором</option>
                            <option value="name">назвою</option>
                        </select>
                    </label>
                </div>

                <div class="div-search">
                    <div>
                        <input class="add-heading-input @error('name') is-invalid @enderror search-issue-input"
                               name="param" placeholder="Шукати" type="text">
                    </div>
                    <div>
                        <button type="submit" class="search-submit">Пошук</button>
                    </div>
                </div>
            </div>
        </form>
        @if($states->count())
        <div>
            <div class="notes-list-div states-list">
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
