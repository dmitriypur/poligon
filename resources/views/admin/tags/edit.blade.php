@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1 class="my-5 text-center">Редактировать тэг</h1>
        <div class="card">
            <form method="post" action="{{ route('tag.update', $tag->id) }}">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ $tag->title }}">
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
