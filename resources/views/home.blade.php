@extends('layouts.main')

@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <img style="height: 400px;object-fit: cover;"
                     src="{{ $favorite->getImage() }}"
                     class="card-img-top" alt="{{ $favorite->title ?? '' }}">
                <div class="card-body">
                    {{--                            <a href="#"><span class="badge bg-primary">{{ $favorite->category->title ?? '' }}</span></a>--}}
                    <h5 class="card-title">{{ $favorite->title ?? '' }}</h5>
                    <p class="card-text">{{ $favorite->preview ?? '' }}.</p>
                    <a href="{{ route('show.post', $favorite->slug) }}" class="btn btn-primary">Далее</a>
                </div>
            </div>
        </div>
        <ul class="col-md-4">
        @include('parts.sidebar')
    </div>
    <section>
        <div class="container">
            <h1 class="text-center">Последние записи</h1>
            <div class="row my-5">
                @foreach($posts as $post)
                    <div class="col-md-4 mb-5">
                        <div class="card">
                            <img
                                src="{{ $post->getImage() }}"
                                class="card-img-top" alt="{{ $post->title }}">
                            <div class="card-body">
                                <span class="post-date">{{ $post->dateAsCarbon }}</span>
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <form class="add-like" action="{{ route('post.like.store', $post->id) }}"
                                      method="post">
                                    @csrf
                                    <span class="text-primary like-count">{{ $post->likes_count }}</span>
                                    <button type="submit" class="like-btn text-primary" data-ico="heart" data-like="0">
                                        @if($post->likes->contains('user_ip', $post->ipUser()))
                                            <i class="fas fa-heart"></i>
                                        @else
                                            <i class="far fa-heart"></i>
                                        @endif
                                    </button>
                                </form>
                                <a href="{{ route('show.post', $post->slug) }}" class="btn btn-primary">Далее</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
