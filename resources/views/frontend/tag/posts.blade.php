@extends('layouts.main')
@section('title', $title)
@section('content')
    <div class="row">
        <ul class="col-md-3">
            @include('parts.sidebar')
        </ul>
        <div class="col-md-9">
            @include('parts.posts-list')
            {{ $posts->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
