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

                <div class="states-heading-input">
                    <label for="category">Категорія</label>
                    <select class="form-control" id="category" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="text" class="add-heading-input @error('name') is-invalid @enderror"
                       placeholder="Ссылка на выпуск" name="link">
                @error('link')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

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
                    <a href="{{ route('start.index') }}">
                        На головну
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
