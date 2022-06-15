@extends('layouts.app')

@section('content')
    <div class="row create-heading row ">
        <div class="create-heading-content col-lg-8 col-sm-12 justify-content-center">
            <form id="form1" method="post" action="{{ route('profiles.update', ['user' => $user->id]) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <div class="create-state-name-heading mb-4">
                        <div class="create-state-name-heading margin-auto-null">
                            <label for="name">
                                Ім'я
                            </label>
                            <input type="text" class="state-name-input @error('name') is-invalid @enderror"
                                   placeholder="Користувач" name="name" value="{{ $user->name }}">
                            @error('name')
                            <div class="alert alert-danger">
                                {{ $message->name }}
                            </div>
                            @enderror
                        </div>

                    </div>
                    <div class="create-state-name-heading mb-4 margin-auto-null label">
                        <label for="password">
                            Пароль
                        </label>
                        <input type="password" class="state-name-input @error('name') is-invalid @enderror"
                               placeholder="Пароль" name="password">
                        @error('password')
                        <div class="alert alert-danger">
                            {{ $message->name }}
                        </div>
                        @enderror
                    </div>
                    <div class="create-state-name-heading mb-4 margin-auto-null">
                        <label for="email">
                            Ел. адреса
                        </label>
                        <input type="text" class="state-name-input @error('email') is-invalid @enderror"
                               placeholder="Автор" name="email" value="{{ $user->email }}">
                        @error('email')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="submit-button">
                    <button type="submit">
                        Відредагувати
                    </button>
                </div>
            </form>

            <div class="to-page">
                <div>
                    <div>
                        <a href="{{ route('start.index') }}">Назад</a>
                    </div>
                    <div>
                        <a href="{{ route('states.store') }}">До статей</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
