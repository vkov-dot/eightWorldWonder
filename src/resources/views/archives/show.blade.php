@extends('layouts.app')

@section('content')
    <div class="row list">
        <div class="col-10 last-states issues-list">
            <div class="col-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('issues.search') }}" class="col-12">
                    @csrf
                    <div class="col-12 search-div">
                        <label>
                            <input type="text" class="add-heading-input @error('name') is-invalid @enderror search-issue-input"
                                   name="param" placeholder="Назва випуску">
                        </label>
                        <button type="submit" class="search-submit">Пошук</button>
                    </div>
                </form>
                <div class="issues-ul">
                    <ul>
                        @foreach($table as $note)
                            <li>
                                <p class="date">
                                    {{ \Carbon\Carbon::parse($note->created_at)->format('d.m.Y') }}
                                </p>
                                <p class="state-name">
                                    {{ $note->name }}
                                </p>
                                <form action="{{ route('archives.destroy', ['table' => $name, 'id' => $note->id]) }}"
                                      class="destroy-issue" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Видалити</button>
                                </form>
                                <form action="{{ route('archives.recover', ['table' => $name, 'id' => $note->id]) }}"
                                      class="recover-issue" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">Відновити</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
