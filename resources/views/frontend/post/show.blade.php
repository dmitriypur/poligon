@extends('layouts.main')

@section('title', $post->title)

@section('content')
    <div class="row">
        <ul class="col-md-3">
            @include('parts.sidebar')
        </ul>
        <div class="col-md-9">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('category.single', $post->category->slug) }}">{{ $post->category->title }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                </ol>
            </nav>
            <div class="card mb-5">
                <img src="{{ $post->getImage() }}" alt="{{ $post->title }}">
                <h1>{{ $post->title }}</h1>
                <p><i class="far fa-eye"></i> <span class="badge bg-primary">{{ $post->view_count }}</span></p>
                <div class="w-25 d-flex justify-content-between align-items-center">
                    <p class="m-0">Автор: {{ $post->user->name }}</p>
                    @if(auth()->user() && auth()->user()->id !== $post->user->id)
                        @if(!auth()->user()->isFollowing($post->user->id))
                            <form action="{{route('user.follow', $post->user->id)}}" method="POST">
                                @csrf
                                <button type="submit" id="follow-user-{{ $post->user->id }}" class="btn btn-link">
                                    Подписаться
                                </button>
                            </form>
                        @else
                            <p class="m-0 text-secondary">Вы подписаны</p>
                        @endif
                    @endif
                </div>

                <p>{!! $post->content !!}</p>
            </div>
            @if($com->count())
                <div class="section-row">
                    @include('frontend.comments.comments_block')
                </div>
            @else
                <h3 class="text-primary">Комментариев пока нет. Будьте первым)</h3>
            @endif
            <div class="section-row">
                @guest()
                    <div class="section-title">
                        <h2>Зарегистрируйтесь для того чтобы оставить комментарий</h2>
                    </div>
                @endguest
                @auth()
                    <div class="section-title">
                        <h2>Оставить комментарий</h2>
                    </div>
                    <form id="respond" action="{{ route('post.comment.store', $post->id) }}" method="post"
                          class="post-reply">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="input" name="message" placeholder="Сообщение"></textarea>
                                    @error('message')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input type="hidden" id="parent_id" name="parent_id" value="0">
                                </div>
                                <button class="primary-button">Отправить</button>
                            </div>
                        </div>
                    </form>
                @endauth
            </div>
        </div>
    </div>

@endsection
