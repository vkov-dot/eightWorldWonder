@extends('layouts.app')

@section('content')
    <div>
        <form method="POST" action="{{ route('issues.store') }}" class="create-task-form">
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
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>

        <div>
            <a href="{{ route('addInfo') }}">
                Назад
            </a>
            <a href="{{ route('states.store') }}">
                К статьям
            </a>
        </div>
    </div>

@endsection
