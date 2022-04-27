@extends('layouts.app')


@section('content')
    <div class="row list">
        <div class="col-12 heading-list">
            <ul class="row heading-list-head col-12">
                @foreach($headings as $heading)
                    <li class=" col-xl-3 col-lg-4 col-sm-6 col-12 heading-list-elem">
                        <div class="heading-image">
                            <a href="{{ route('headings.show', ['heading' => $heading->id ]) }}">
                                <img src="{{ asset("storage/".$heading->image) }}" alt="аватар">
                            </a>
                        </div>
                        <a href="{{ route('headings.show', ['heading' => $heading->id ]) }}" class="state-name">
                            {{ $heading->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
