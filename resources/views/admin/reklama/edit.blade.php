@extends('admin.layouts.main')
@section('content')
    <div class="container">
        <h1 class="my-5 text-center">Редактировать запись</h1>
        <div class="card">
            <form method="post" action="{{ route('reklama.update', $reklama->id) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Заголовок" value="{{ $reklama->title }}">
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link">Ссылка</label>
                        <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="Ссылка" value="{{ $reklama->link }}">
                        @error('link')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Текст</label>
                        <textarea id="summernote" name="content" class="form-control @error('content') is-invalid @enderror" rows="3" placeholder="Текст">{{ $reklama->content ?? '' }}</textarea>
                        @error('content')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Категория</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $key => $category)
                                <option
                                    {{ $reklama->category_id == $key ? 'selected' : '' }}
                                    value="{{ $key }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-25">
                        <img src="{{ $reklama->getImage() }}" style="width: 100%;"
                             alt="{{ $reklama->title }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="image" type="file" class="custom-file-input" value="{{ $reklama->image }}" id="image">
                                <label class="custom-file-label" for="image">Выбрать</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input id="publish" {{ $reklama->publish ? 'checked' : '' }} class="form-check-input" type="checkbox" name="publish">
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
