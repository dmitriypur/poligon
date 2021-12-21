@extends('admin.layouts.main')
@section('content')
    <div class="container">
        <h1 class="my-5 text-center">Редактировать запись</h1>
        <div class="card">
            <form method="post" action="{{ route('comment.update', $comment->id) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label>Комментарий</label>
                        <textarea name="message" class="form-control" rows="3" placeholder="Комментарий">{{ $comment->message ?? '' }}</textarea>
                        @error('preview')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input id="publish" {{ $comment->publish ? 'checked' : '' }} class="form-check-input" type="checkbox" name="publish">
                        <label for="publish" class="form-check-label">Опубликовать</label>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
