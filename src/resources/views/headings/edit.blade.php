@extends('layouts.app')

@section('content')
    <div class="row create-heading">
        <div class="create-heading-content">
            <form method="post" action="{{ route('headings.update', ['heading' => $heading->id]) }}"
                  class="create-heading-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <input type="text" class="add-heading-input @error('name') is-invalid @enderror"
                           placeholder="Назва рубрики" name="name" value="{{ $heading->name }}">
                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="mb-3">
                        <label for="formFile" class="form-label">
                            Аватар рубрики
                        </label>
                        <input class="form-control" type="file" id="formFile" name="image" value="{{ $heading->image }}">
                        @error('image')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="submit-button">
                    <button type="submit">
                        Создать
                    </button>
                </div>
            </form>

            <div class="to-page">
                <div>
                    <a href="{{ route('headings.show', ['heading' => $heading->id]) }}">
                        Назад
                    </a>
                    <a href="{{ route('start.index') }}">
                        На головну
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
