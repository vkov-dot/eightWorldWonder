@extends('layouts.app')

@section('content')
    <div class="row create-heading">
        <div class="create-heading-content">
            <form method="POST" action="{{ route('photos.store') }}" class="create-heading-form">
                @csrf
                <div>
                    <div class="form-group">
                        <label for="media_folder_id">Папка</label>
                        <select class="form-control" name="media_folder_id">
                            @foreach($mediaFolders as $folder)
                                <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="text" class="add-heading-input @error('name') is-invalid @enderror"
                               placeholder="Назва фото" name="name">
                        @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" class="add-heading-input @error('link') is-invalid @enderror"
                               placeholder="Посилання" name="link">
                        @error('link')
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
