@extends('layouts.app')

@section('content')
    <div class="row">
        <form method="POST" action="{{ route('headings.store') }}" class="create-task-form">
            @csrf
            <input type="text" class="add-heading-input @error('name') is-invalid @enderror"
                   placeholder="Название рубрики" name="name">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
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
