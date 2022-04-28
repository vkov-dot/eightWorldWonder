@extends('layouts.app')


@section('content')
    <div class="row create-heading">
        <div class="create-heading-content">
            <form id="form1" method="post" action="{{ route('states.update', ['state' => $state->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <div class="form-group">
                        <input type="text" class="state-name-input @error('name') is-invalid @enderror"
                               placeholder="Название статьи" name="title" value="{{ $state->title }}">
                        @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="states-heading-input">
                            <label for="category">
                                Рубрика
                            </label>
                            <select class="form-control" id="heading" name="heading_id">
                                @foreach($headings as $heading)
                                    <option value="{{ $heading->id }}">
                                        {{ $heading->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">
                            Титульная картинка
                        </label>
                        <input class="form-control" type="file" id="formFile" name="logo">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    <script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
                    <textarea name="body">
                        {!! $state->body !!}
                    </textarea>
                    <script>
                        CKEDITOR.replace('body');
                    </script>
                    @error('body')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="state-author-div">
                        <input type="text" class="state-author-input @error('name') is-invalid @enderror"
                               placeholder="Автор" name="author" value="{{ $state->author }}">
                        @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="submit-button">
                    <button type="submit">
                        Відредагувати
                    </button>
                </div>
            </form>

            <div class="to-page">
                <div>
                    <div>
                        <a href="{{ route('addInfo') }}">Назад</a>
                    </div>
                    <div>
                        <a href="{{ route('states.store') }}">До статей</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
