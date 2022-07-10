@extends('layouts.app')


@section('content')
    <div class="row start-section">
        <div class="col-lg-5 col-md-12 last-states">
            <last-states-list :states="{{ $lastStates }}" v-if="{{ $lastStates->count() }}"></last-states-list>
            <last-issues-list :issues="{{ $lastIssues }}" v-if="{{ $lastIssues->count() }}"></last-issues-list>
        </div>
        <div class="col-lg-7 col-md-12 mt-4">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button"
                            data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="0" class="active"
                            aria-current="true"
                            aria-label="Slide 1">
                    </button>
                    <button type="button"
                            data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="1"
                            aria-label="Slide 2">
                    </button>
                    <button type="button"
                            data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="2"
                            aria-label="Slide 3">
                    </button>
                    <button type="button"
                            data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="3"
                            aria-label="Slide 4">
                    </button>
                    <button type="button"
                            data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="4"
                            aria-label="Slide 5">
                    </button>
                </div>
                <div class="carousel-inner">
                    @foreach($lastStates as $key => $state)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset("storage/".$state->logo) }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <p>
                                    <a href="{{ route('states.show', ['state' => $state->id ]) }}"
                                       class="slider-link">
                                        {{ $state->name }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
@endsection
