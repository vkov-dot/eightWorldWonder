@extends('layouts.app')

@section('content')
    <div class="row list">
        <div class="col-10 last-states issues-list">
            <div class="col-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('issues.search') }}" class="col-12">
                    @csrf
                    <div class="col-12 search-div">
                        <input type="text"
                               class="add-heading-input @error('name') is-invalid @enderror search-issue-input"
                               name="param" placeholder="Назва випуску">
                        <button type="submit" class="search-submit">Пошук</button>
                    </div>
                </form>
                @if($issues->count())
                <div>
                    <div class="notes-list-div states-list">
                        <ul>
                            @foreach($issues as $issue)
                                <li>
                                    <p class="date">
                                        {{ \Carbon\Carbon::parse($issue->created_at)->format('d.m.Y') }}
                                    </p>
                                    <a href="{{ $issue->link }}" class="state-name" target="_blank">
                                        {{ $issue->name }}
                                    </a>
                                    <form action="{{ route('issues.destroy', ['id' => $issue->id]) }}"
                                          class="destroy-issue" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Видалити</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @if($issues->total() > $issues->count())
                        <div class="row justify-content-center">
                            <div class="pagination-first-parent">
                                <div class="card">
                                    <div class="card-body pagination">
                                        {{ $issues->onEachSide(2)->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @endif
                </div>
        </div>
@endsection
