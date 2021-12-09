@extends('layouts.main')
@section('title', $title)
@section('content')
    <div class="row">
        <h2>{{ $title }}</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
        @foreach($categories as $category)
            <div class="col-md-4">
                <a href="{{ route('category.single', $category->slug) }}">
                    <div class="card bg-dark text-white">
                        <img src="{{ $category->getImage() }}" class="card-img" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title">{{ $category->title }}</h5>
                            <p class="card-text">{{ $category->description }}</p>
                            <p>{{ $category->posts->count() }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
