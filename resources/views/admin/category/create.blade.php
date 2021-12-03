@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1 class="my-5 text-center">Добавить категорию</h1>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('category.store') }}" enctype="multipart/form-data" method="post" class="col-6">
                    @csrf
                    @include('admin.category._form')
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
