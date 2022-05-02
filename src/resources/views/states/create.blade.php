@extends('layouts.app')


@section('content')
    <div class="row create-heading">
        <div class="create-heading-content">
            <form id="form1" method="post" action="{{ route('states.store') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <div class="form-group create-state-name-heading">
                        <div class="state-name-div">
                            <input type="text" class="state-name-input @error('name') is-invalid @enderror"
                                   placeholder="Название статьи" name="name">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="states-heading-input">
                            <label for="category">Рубрика</label>
                            <select class="form-control" id="heading" name="heading_id">
                                @foreach($headings as $heading)
                                    <option value="{{ $heading->id }}">{{ $heading->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="state-logo-input">
                        <div>
                            <label for="formFile" class="form-label">Титульная картинка</label>
                            <input class="form-control" type="file" id="formFile" name="logo">
                        </div>
                        @error('logo')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
                    <textarea name="body"></textarea>
                    <script>
                        CKEDITOR.replace('body');
                    </script>
                    @error('body')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="state-author-div">
                        <input type="text" class="state-author-input @error('name') is-invalid @enderror"
                               placeholder="Автор" name="author">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="submit-button">
                    <button type="submit">Створити</button>
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
