@extends('layouts.app')

@section('content')
    <div class="row create-heading">
        <div class="create-heading-content">
            <form method="POST" action="{{ route('headings.store') }}"
                  class="create-heading-form" enctype="multipart/form-data">
                @csrf
                <div>
                    <input type="text" class="add-heading-input @error('name') is-invalid @enderror"
                           placeholder="Назва рубрики" name="name">
                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Аватар рубрики</label>
                        <input class="form-control" type="file" id="formFile" name="image">
                    </div>
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
