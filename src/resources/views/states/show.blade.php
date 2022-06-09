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
                                    @if(Auth::user() && Auth::user()->admin)
                                   <form action="{{ route('states.comments.destroy', ['state' => $state->id, 'id' => $comment->id]) }}"
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
