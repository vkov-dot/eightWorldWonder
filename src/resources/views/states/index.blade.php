@extends('layouts.app')

@section('content')
    <div class="last-states issues-list">

        <form method="post" enctype="multipart/form-data" action="{{ route('states.sort') }}" class="search-issue-form">
            @csrf
            <label for="sort" class="sort-by states-search-label mb-2">
                <p class="mr-1">
                    Сортування:
                </p>
                <select class="form-control select-sort" id="search" name="sort">
                    <option value="asc" type="submit">
                        новіше
                    </option>
                    <option value="desc" type="submit">
                        старіше
                    </option>
                </select>
                <input type="submit" value="Сортувати" class=" btn btn-primary">
            </label>
        </form>

        <form method="post" enctype="multipart/form-data" action="{{ route('states.search') }}"
              class="search-issue-form">
            @csrf
            <div class="form-group col-12 search-issue-select states-search-div">
                <div class="search-issue-select-first-d">
                    <label for="category" class="states-search-label">
                        <p>
                            Шукати за
                        </p>
                        <select class="form-control" id="search" name="message">
                            <option value="author">
                                автором
                            </option>
                            <option value="name">
                                назвою
                            </option>
                        </select>
                    </label>
                </div>

                <div class="div-search">
                    <div>
                        <input class="add-heading-input @error('name') is-invalid @enderror search-issue-input"
                               name="param" placeholder="Шукати"
                               type="text" {{--value="{{ asset($message) ? $message : ''}}"--}} >
                    </div>
                    <div>
                        <button type="submit" class="search-submit">Пошук</button>
                    </div>
                </div>
            </div>
        </form>
        @if($states->count())
            <index-states-list :states="{{ $states }}"></index-states-list>
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
