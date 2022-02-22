@extends('layouts.app')

@section('content')
    <div class="row create-heading">
        <div class="create-heading-content">
            <form method="POST" action="{{ route('media.store') }}" class="create-heading-form">
                @csrf
                <div>
                    <div class="form-group">
                        <label for="category">Рубрика</label>
                        <select class="form-control" id="heading" name="heading_id">
                            @foreach($mediaFolders as $folder)
                                <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" class="add-heading-input @error('name') is-invalid @enderror"
                           placeholder="Добавить папку" name="name">
                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    <input type="text" class="add-heading-input @error('name') is-invalid @enderror"
                           placeholder="Ссылка на фото" name="name">
                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    <input type="text" class="add-heading-input @error('name') is-invalid @enderror"
                           placeholder="Ссылка на видео" name="name">
                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="submit-button">
                    <button type="submit">
                        Создать
                    </button>
                </div>
            </form>

            <div class="to-page">
                <div>
                    <a href="{{ route('addInfo') }}">
                        Назад
                    </a>
                    <a href="{{ route('states.store') }}">
                        К статьям
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
