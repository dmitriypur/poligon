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
                    <li class="breadcrumb-item"><a href="{{ route('category.single', $post->category->slug) }}">{{ $post->category->title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                </ol>
            </nav>
            <div class="card mb-5">
                <img src="{{ $post->getImage() }}" alt="{{ $post->title }}">
                <h1>{{ $post->title }}</h1>
                <p><i class="far fa-eye"></i> <span class="badge bg-primary">{{ $post->view_count }}</span></p>
                <p>{!! $post->content !!}</p>
            </div>
        </div>
    </div>
@endsection
