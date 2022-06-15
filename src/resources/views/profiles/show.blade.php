@extends('layouts.app')

@section('content')
    <div class="row create-heading row ">
        <div class="create-heading-content col-lg-8 col-sm-12 justify-content-center">
            <div>
                <div>
                    <div class="mb-4 profile-show-list-div">
                        <div class="margin-auto-null">
                            <p>
                                Ім'я {{ $profile->name }}
                            </p>
                        </div>
                        <div class="margin-auto-null label">
                            <p>
                                Роль: {{ $profile->admin ? 'Адмін' : 'Користувач'}}
                            </p>
                        </div>
                        <div class="create-state-name-heading mb-4 margin-auto-null">
                            <p>
                                Електронна адреса {{ $profile->email }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="profile-edit-link">
                    <a href="{{ route('profiles.edit', ['profile' => $profile->id]) }}">
                        Редагувати
                    </a>
                </div>
            </div>

            <div class="to-page">
                <div>
                    <div>
                        <a href="{{ route('start.index') }}">На головну</a>
                    </div>
                    <div>
                        <a href="{{ route('states.store') }}">До статей</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
