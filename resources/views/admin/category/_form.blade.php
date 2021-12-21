<div class="form-group">
    <label for="title">Название</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Заголовок" value="{{ $category->title ?? old('title') }}">
    @error('title')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label>Текст</label>
    <textarea name="description" class="form-control" rows="3" placeholder="Текст">{{ $category->description ?? old('description') }}</textarea>
    @error('description')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
@if($category)
<div class="w-25">
    <img src="{{ $category->getImage() }}" style="width: 100%;" alt="{{ $category->title ?? '' }}">
</div>
@endif
<div class="form-group">
    <label for="exampleInputFile">Изображение</label>
    <div class="input-group">
        <div class="custom-file">
            <input name="image" type="file" class="custom-file-input" id="image">
            <label class="custom-file-label" for="image">Выбрать</label>
        </div>
    </div>
    @error('image')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>

{{--<div class="form-group mb-3">--}}
{{--    <label>Категория</label>--}}
{{--    <select name="parent_id" class="form-control">--}}
{{--        <option value="0">-- без категории --</option>--}}
{{--        @include('admin.category._categories')--}}
{{--    </select>--}}
{{--</div>--}}
<button type="submit" class="btn btn-primary">Сохранить</button>
