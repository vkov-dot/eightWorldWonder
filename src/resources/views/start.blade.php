@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-4 last-states">
            <div class="last-states-title">
                <p>Последние статьи</p>
            </div>
            <ul>
                @foreach($lastStates as $state)
                    <li>
                        <p class="date">
                            {{ $state->date }}
                        </p>
                        <a href="{{ route('states.show', ['state' => $state->id ]) }}" class="state-name">
                            {{ $state->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-8 mt-4">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    @foreach($lastStates as $state)
                        <div class="carousel-item active">
                            <img src="{{ asset( $state->titleImage) }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <p>{{ $state->title }}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="carousel-item active">
                        <img src="{{ asset('img/img.png') }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $state->title }}</h5>
                        </div>
                    </div>
                        <div class="carousel-item active">
                            <img src="{{ asset('img/img.png') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $state->title }}</h5>
                            </div>
                        </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/img_1.png') }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Метка второго слайда</h5>
                            <p>Некоторый репрезентативный заполнитель для второго слайда.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/img_2.png') }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Метка третьего слайда</h5>
                            <p>Некоторый репрезентативный заполнитель для третьего слайда.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Предыдущий</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Следующий</span>
                </button>
            </div>
        </div>
    </div>
@endsection



