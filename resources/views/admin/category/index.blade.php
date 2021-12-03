@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1 class="my-5">Категории</h1>
        <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Создать категорию</a>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Название</th>
                        <th>Изображение</th>
                        <th style="width: 100px">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->title ?? '' }}</td>
                            <td>
                                <img src="{{ $category->getImage() }}" style="width: 80px;" alt="{{ $category->title ?? '' }}">
                            </td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <form action="{{ route('category.destroy', $category->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="2">
                                <h1>Категории отсутствуют</h1>
                            </th>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $categories->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
