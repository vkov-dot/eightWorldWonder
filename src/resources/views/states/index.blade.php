@extends('layouts.app')

@section('content')
    <div class="last-states issues-list">
        <form method="post" enctype="multipart/form-data" action="{{ route('states.search') }}"
              class="search-issue-form">
            @csrf
            <div class="form-group col-12 search-issue-select states-search-div">
                <div>
                    <label for="category" class="states-search-label">
                        <p>Шукати за</p>
                        <select class="form-control" id="search" name="message">
                            <option value="author">автором</option>
                            <option value="title">назвою</option>
                        </select>
                    </label>
                </div>

                <div class="div-search">
                    <div>
                        <input type="text" class="add-heading-input @error('name') is-invalid @enderror search-issue-input"
                               name="param" placeholder="Шукати">
                    </div>
                    <div>
                        <button type="submit" class="search-submit">Пошук</button>
                    </div>
                </div>
            </div>
        </form>
        <ul>
            @foreach($states as $state)
                <li>
                    <p class="date">
                        {{ \Carbon\Carbon::parse($state->created_at)->format('d.m.Y') }}
                    </p>
                    <a href="{{ route('states.show', ['state' => $state->id]) }}" class="state-name">
                        {{ $state->title }}
                    </a>
                    <p class="state-author">{{ $state->author }}</p>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
