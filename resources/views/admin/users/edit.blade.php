@extends('admin.layouts.main')
@section('content')
    <div class="container">
        <h1 class="my-5 text-center">Редактировать запись</h1>
        <div class="card">
            <form method="post" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{  old('name') ?? $user->name }}">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lastname">Фамилия</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" value="{{  old('lastname') ?? $user->lastname }}">
                        @error('lastname')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="surname">Отчество</label>
                        <input type="text" name="surname" class="form-control" id="surname" value="{{  old('surname') ?? $user->surname }}">
                        @error('surname')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{  old('email') ?? $user->email }}">
                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{  old('phone') ?? $user->phone }}">
                        @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Адрес</label>
                        <input type="text" name="address" class="form-control" id="address" value="{{  old('address') ?? $user->address }}">
                        @error('address')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="organization">Организация и должность</label>
                        <textarea name="organization" class="form-control" rows="3" placeholder="Текст">{{ old('organization') ?? $user->organization }}</textarea>
                        @error('organization')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="about">О себе</label>
                        <textarea name="about" class="form-control" rows="3" placeholder="Текст">{{ old('about') ?? $user->about }}</textarea>
                        @error('about')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label>День рождения:</label>
                        <input type="date" name="dr" class="form-control datetimepicker-input" value="{{  old('dr') ?? $user->dr }}">
                    </div>

                    <div class="w-25">
                        <img src="{{ $user->getImage() }}" style="width: 100%;" alt="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="photo" type="file" class="custom-file-input" id="image" value="{{ auth()->user()->photo }}">
                                <label class="custom-file-label" for="image">Выбрать</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="form-group">
                        <label>Допуск пользователя</label>
                        <select name="is_admin" class="form-control">
                            @foreach($roles as $id => $role)
                                <option value="{{ $id }}"
                                    {{ $id == $user->is_admin ? ' selected' : '' }}
                                >{{ $role }}</option>
                            @endforeach
                        </select>
                        @error('is_admin')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
{{--
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
