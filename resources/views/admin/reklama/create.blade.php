@extends('admin.layouts.main')
@section('content')
    <div class="container">
        <h1 class="my-5 text-center">Добавить запись</h1>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ route('reklama.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Заголовок" value="{{ old('title') }}">
                            @error('title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="link">Ссылка</label>
                            <input type="text" name="link" class="form-control" id="link" placeholder="Ссылка" value="{{ old('link') }}">
                            @error('link')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Текст</label>
                            <textarea id="summernote" name="content" class="form-control" rows="3" placeholder="Текст">{{ old('title') }}</textarea>
                            @error('content')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $key => $category)
                                    <option value="{{ $key }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Изображение</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Выбрать</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input id="publish" class="form-check-input" type="checkbox" name="publish">
                            <label for="publish" class="form-check-label">Опубликовать</label>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
