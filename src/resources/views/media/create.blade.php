@extends('layouts.app')

@section('content')
    <div class="row create-heading">
        <div class="create-heading-content">
            <form method="POST" action="{{ route('media.store') }}" class="create-heading-form">
                @csrf
                <div>
                    <input type="text" class="add-heading-input @error('name') is-invalid @enderror"
                           placeholder="Додати папку" name="name">
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
                    <a href="{{ route('start.index') }}">
                        На головну
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
