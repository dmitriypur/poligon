@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1 class="my-5 text-center">Добавить тэг</h1>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ route('tag.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Название тэга">
                            @error('title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
