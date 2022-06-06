@extends('layouts.app')

@section('content')
    <div class="row list">
        <div class="col-lg-10 col-sm-12 last-states issues-list">
            <div class="col-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('issues.search') }}" class="col-12">
                    @csrf
                    <div class="col-12 search-div">
                        <label>
                            <input type="text"
                                   class="add-heading-input @error('name') is-invalid @enderror search-issue-input"
                                   name="param" placeholder="Назва випуску">
                        </label>
                        <button type="submit" class="search-submit">Пошук</button>
                    </div>
                </form>
                @if($table->count())
                <div class="issues-ul">
                    <div>
                        <div class="notes-list-div states-list">
                            <ul>
                                @foreach($table as $note)
                                    <li>
                                        <p class="date">
                                            {{ \Carbon\Carbon::parse($note->created_at)->format('d.m.Y') }}
                                        </p>
                                        <a href="{{ $name === 'issues' ? $note->link : route('states.show', ['state' => $note->id]) }}"
                                           class="state-name">
                                            {{ $note->name }}
                                        </a>
                                        <div class="destroy-recover-div">
                                            <form action="{{ route($name.'.destroy', ['id' => $note->id]) }}"
                                                  method="post" class="destroy-note-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="destroy-note-submit">Видалити</button>
                                            </form>
                                            <form action="{{ route($name.'.recover', ['id' => $note->id]) }}"
                                                  class="recover-note-form" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="recover-note-submit">Відновити</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
