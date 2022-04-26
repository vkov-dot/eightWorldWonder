@extends('layouts.app')

@section('content')
    <div class="row list">
        <div class="col-10 last-states issues-list">
            <div class="col-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('states.search') }}" class="search-issue-form">
                    @csrf
                        <div class="form-group col-12 search-issue-select states-search-div">
                            <label for="category" class="states-search-label">
                                <p>Шукати за</p>
                                <select class="form-control" id="search" name="message">
                                    <option value="author">автором</option>
                                    <option value="title">назвою</option>
                                </select>
                            </label>
                            <div>
                                <input type="text" class="add-heading-input @error('name') is-invalid @enderror search-issue-input"
                                       name="param" placeholder="Шукати">
                                <button type="submit" class="search-submit">Пошук</button>
                            </div>
                        </div>
                </form>
                <ul class="states-list">
                    @foreach($states as $state)
                        <li>
                            <p class="date">
                                {{ \Carbon\Carbon::parse($state->created_at)->format('d.m.Y') }}
                            </p>
                            <a href="{{ route('states.show', ['state' => $state->id]) }}" class="state-name">
                                {{ $state->title }}
                            </a>
                            <p>{{ $state->author }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
