@extends('layouts.app')

@section('content')
    <div class="row create-heading">
        <div class="create-heading-content">
            <form method="POST" action="{{ route('states.store') }}"
                  class="create-heading-form" enctype="multipart/form-data">
                @csrf
                <div>
                    <input type="text" class="add-heading-input @error('name') is-invalid @enderror" placeholder="Название статьи" name="title">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="category">Рубрика</label>
                        <select class="form-control" id="heading" name="heading_id">
                            @foreach($headings as $heading)
                                <option value="{{ $heading->id }}">{{ $heading->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Титульная картинка</label>
                        <input class="form-control" type="file" id="formFile" name="logo">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <textarea class="form-control" id="formFile" name="body" placeholder="Текст статьи"></textarea>
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="submit-button">
                    <button type="submit">Создать</button>
                </div>
            </form>

            <div class="to-page">
                <div>
                    <a href="{{ route('addInfo') }}">Назад</a>
                    <a href="{{ route('states.store') }}">К статьям</a>
                </div>
            </div>
        </div>
    </div>


@endsection
