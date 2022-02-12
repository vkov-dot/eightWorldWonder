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
                            {{ $state->created_at }}
                        </p>
                        <a href="#" class="state-name">
                            {{ $state->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-8">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('img/img.png') }}" alt="Первый слайд">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('img/img_1.png') }}" alt="Второй слайд">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('img/img_2.png') }}" alt="Третий слайд">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
@endsection



