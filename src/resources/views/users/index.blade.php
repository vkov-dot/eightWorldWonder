@extends('layouts.app')

@section('content')
    <div class="last-states issues-list">
        <form method="post" enctype="multipart/form-data" action="{{ route('users.search') }}"
              class="search-issue-form">
            @csrf
            <div class="form-group col-12 search-issue-select states-search-div">
                <div class="search-issue-select-first-d">
                    <label class="states-search-label">
                        <p>
                            Шукати за
                        </p>
                        <select class="form-control" id="search" name="message">
                            <option value="name">
                                ім'ям
                            </option>
                            <option value="email">
                                поштою
                            </option>
                        </select>
                    </label>
                </div>

                <div class="div-search">
                    <div>
                        <input class="add-heading-input @error('name') is-invalid @enderror search-issue-input"
                               name="param" placeholder="Шукати" type="text">
                    </div>
                    <div>
                        <button type="submit" class="search-submit">
                            Пошук
                        </button>
                    </div>
                </div>
            </div>
        </form>
        @if($users->count())
            <div>
                <div class="notes-list-div states-list">
                    <ul>
                        @foreach($users as $user)
                            <li>
                                <p class="date">
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y') }}
                                </p>
                                <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="state-name">
                                    {{ $user->name }}
                                </a>
                                <p class="state-author">
                                    {{ $user->email }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if($users->total() > $users->count())
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body pagination">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>

@endsection
