@extends('layouts.app')



@section('content')
    <div class="row state-show-main-div">
        @if($lastStates->count())
            <div class="col-xl-4 col-lg-12 last-states notes-list-div">
                <ul class="states-list">
                    <div class="last-states-title border-bottom-grey">
                        <p>
                            Останні статті
                        </p>
                    </div>
                    @foreach($lastStates as $states)
                        <li>
                            <p class="date">
                                {{ \Carbon\Carbon::setLocale('uk') }}
                                {{ \Carbon\Carbon::parse($states->created_at)->format('d.m.Y') }}
                            </p>
                            <a href="{{ route('states.show', ['state' => $states->id ]) }}" class="state-name">
                                {{ $states->name }}
                            </a>
                            <p class="author">
                                {{ $states->author }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="last-states col-xl-8 col-lg-12">
            <div class=" states state-show-div">
                <div>
                    <p class="state-show-name">
                        {{ $state->name }}
                    </p>
                    <div>
                        <form action="{{route('rating.store', ['state_id' => $state->id])}}"
                              id="addStar" method="POST" class="form-horizontal poststars" >
                            @csrf
                            <div class="required">
                                <div class="col-sm-12">
                                    <div class="state-rating-div">
                                        <p class="state-rating-p">
                                            Середня: {{ $state->rating }}
                                        </p>
                                        <p class="state-rating-p">
                                            Вже оцінили: {{ $state->ratingCount }}
                                        </p>
                                    </div>
                                    <div>
                                        <input class="star star-5" value="5" id="star-5" type="submit" name="star"/>
                                        <label class="star star-5" for="star-5"></label>
                                        <input class="star star-4" value="4" id="star-4" type="submit" name="star"/>
                                        <label class="star star-4" for="star-4"></label>
                                        <input class="star star-3" value="3" id="star-3" type="submit" name="star"/>
                                        <label class="star star-3" for="star-3"></label>
                                        <input class="star star-2" value="2" id="star-2" type="submit" name="star"/>
                                        <label class="star star-2" for="star-2"></label>
                                        <input class="star star-1" value="1" id="star-1" type="submit" name="star"/>
                                        <label class="star star-1" for="star-1"></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <img src="{{ asset("storage/".$state->logo) }}" class="d-block w-100"
                         alt="Нажаль даного зображення немає :(">
                    <p>
                        {!! $state->body !!}
                    </p>
                    <p class="state-show-author">
                        {{ $state->author }}
                    </p>
                    @if(Auth::user() && Auth::user()->admin)
                        <div class="state-show-redact-destroy">
                            <div class="redact-state-link">
                                <a href="{{ route("states.edit", ['state' => $state->id]) }}">
                                    Редагувати
                                </a>
                            </div>
                            <form action="{{ route('states.destroy', ['id' => $state->id]) }}" class="destroy-state"
                                  method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    До архіва
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            <div class="last-states states state-show-div">
                <div class="comments-count">
                    <p>
                        Коментарі: {{ $state->comments->count() }}
                    </p>
                </div>
                @auth()
                    <div class="row">
                        <form action="{{ route('states.comments.store', ['state' => $state->id]) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 comment-send-div">
                                <textarea class="comment-message" name="message" rows="1"
                                          placeholder="Додати коментар"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-12 comment-submit">
                                        <input type="submit" value="Опублікувати" class="btn">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endauth
                <div class="comment-list">
                    <div>
                        @foreach($state->comments as $comment)
                            <div>
                                <div class="comment-element justify-content-between">
                                    <div class="comment-element">
                                        <p>
                                            {{ $comment->user->name }}
                                        </p>
                                        <p class="comment-date">
                                            {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                                        </p>
                                    </div>
                                    @if(Auth::user() && Auth::user()->admin || Auth::id() === $comment->user_id)
                                        <form
                                            action="{{ route('states.comments.destroy', ['state' => $state->id, 'comment' => $comment]) }}"
                                            enctype="multipart/form-data" class="delete-comment" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="&#215;">
                                        </form>
                                    @endif
                                </div>
                                <div>
                                    <p>
                                        {{ $comment->message }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
