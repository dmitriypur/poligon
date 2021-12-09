@extends('admin.layouts.main')
@section('content')
    <div class="container">
        <h1 class="my-5 text-center">Редактировать запись</h1>
        <div class="card">
            <form method="post" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Заголовок" value="{{ $post->title }}">
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Краткое описание</label>
                        <textarea name="preview" class="form-control" rows="3" placeholder="Краткое описание">{{ $post->preview ?? '' }}</textarea>
                        @error('preview')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Текст</label>
                        <textarea id="summernote" name="content" class="form-control @error('content') is-invalid @enderror" rows="3" placeholder="Текст">{{ $post->content ?? '' }}</textarea>
                        @error('content')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Категория</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $key => $category)
                                <option
                                    {{ $post->category_id == $key ? 'selected' : '' }}
                                    value="{{ $key }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Тэги</label>
                        <select class="select2" name="tag_ids[]" multiple="multiple" data-placeholder="Выбрать тэги" style="width: 100%;">
                            @foreach($tags as $key => $tag)
                                <option @if(in_array($key, $post->tags->pluck('id')->all())) selected @endif value="{{ $key }}">{{ $tag }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-25">
                        <img src="{{ $post->getImage() }}" style="width: 100%;"
                             alt="{{ $post->title }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="image" type="file" class="custom-file-input" value="{{ $post->image }}" id="image">
                                <label class="custom-file-label" for="image">Выбрать</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input id="publish" {{ $post->publish ? 'checked' : '' }} class="form-check-input" type="checkbox" name="publish">
                        <label for="publish" class="form-check-label">Опубликовать</label>
                    </div>
                    <div class="form-check">
                        <input id="favorite" {{ $post->favorite ? 'checked' : '' }} class="form-check-input" type="checkbox" name="favorite">
                        <label for="favorite" class="form-check-label">Вывести на главной</label>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
