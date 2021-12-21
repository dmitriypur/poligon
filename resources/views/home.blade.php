@extends('layouts.main')

@section('title', $title)
@section('content')
    <div class="row mb-5">
        <div class="col-md-8">
            @if($favorite)
                <div class="card">
                    <img style="height: 400px;object-fit: cover;"
                         src="{{ $favorite->getImage() }}"
                         class="card-img-top" alt="{{ $favorite->title ?? '' }}">
                    <div class="card-body">

                        <h5 class="card-title">{{ $favorite->title ?? '' }}</h5>
                        <p class="card-text">{{ $favorite->preview ?? '' }}.</p>
                        <a href="{{ route('show.post', $favorite->slug) }}" class="btn btn-primary">Далее</a>
                    </div>
                </div>
            @endif
        </div>
        <ul class="col-md-4">
        @include('parts.sidebar')
    </div>

    <h1 class="text-center">Последние записи</h1>
    <div class="row my-5">
        @foreach($posts as $k => $post)
            @if($k != 0 && $k % 5 == 0 && $reklama->count())
                <div class="col-md-4 mb-5">
                    <a href="{{ $reklama[0]->link }}" target="_blank">
                        <div class="card bg-dark text-white">
                            <img src="{{ $reklama[0]->getImage() }}" class="card-img" alt="{{ $reklama[0]->title }}">
                            <div class="card-img-overlay">
                                <h5 class="card-title">{{ $reklama[0]->title }}</h5>
                                <p class="card-text">{!! $reklama[0]->content !!}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @continue
            @endif
            <div class="col-md-4 mb-5">
                <div class="card">
                    <img src="{{ $post->getImage() }}" class="card-img-top" alt="{{ $post->title }}">
                    <div class="card-body">
                        <span class="post-date">{{ $post->dateAsCarbon }}</span>
                        <h5 class="card-title">{{ $post->title }}</h5>
                        @include('parts.likes')
                        @include('parts.bookmark')
                        <a href="{{ route('show.post', $post->slug) }}" class="btn btn-primary">Далее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <h1 class="text-center">Популярные записи</h1>

    <div class="simple-slider simple-slider-first mb-5">
        <div class="slider-wrapper row">
            <!-- First slide -->
            @foreach($postsSlider as $post)
                <div class="slider-slide col-md-4">
                    <div class="card">
                        <img src="{{ $post->getImage() }}" class="card-img-top" alt="{{ $post->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <a href="{{ route('show.post', $post->slug) }}" class="btn btn-primary">Далее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!--Pagination (Not required)-->
        <div class="slider-pagination"></div>

        <!-- Buttons (Not required) -->
        <div class="slider-btn slider-btn-prev"></div>
        <div class="slider-btn slider-btn-next"></div>
    </div>

@endsection
@section('scripts')
    <script src="https://unpkg.com/simpleslider-js@1.9.0/dist/simpleSlider.min.js"></script>
    <script>
        new SimpleSlider('.simple-slider-first', {
            slidesPerView: {
                768: 2,
                1024: 3,
            },
            autoplay: true,

        });
    </script>
@endsection
