@extends('layouts.app')

@section('content')
    <div class="row create-heading">
        <div class="create-heading-content">
            <form method="POST" action="{{ route('issues.store') }}" class="create-heading-form">
                @csrf
                <input type="text" class="add-heading-input @error('name') is-invalid @enderror"
                       placeholder="Название выпуска" name="name">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <input type="text" class="add-heading-input @error('name') is-invalid @enderror"
                       placeholder="Ссылка на выпуск" name="link">
                @error('link')
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
                    <a href="{{ route('issues.store') }}">
                        К статьям
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
