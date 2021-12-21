@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1 class="my-5">Записи</h1>
        <a href="{{ route('post.create') }}" class="btn btn-primary mb-3">Создать запись</a>
        <a href="{{ route('trash') }}" class="btn btn-danger mb-3">Корзина</a>

        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Название</th>
                        <th>Опубликовано</th>
                        <th>Вывод на главной</th>
                        <th>Изображение</th>
                        <th style="width: 100px">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title ?? '' }}</td>
                            <td class="{{ $post->publish ? 'text-success' : 'text-danger' }}">{{ $post->publish ? 'Да' : 'Нет' }}</td>
                            <td class="{{ $post->favorite ? 'text-success' : 'text-danger' }}">{{ $post->favorite ? 'Да' : 'Нет' }}</td>
                            <td>
                                <img src="{{ $post->getImage() }}" style="width: 80px;" alt="{{ $post->title ?? '' }}">
                            </td>
                            <td>
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <form action="{{ route('post.destroy', $post->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="2">
                                <h1>Записи отсутствуют</h1>
                            </th>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Название</th>
                        <th>Опубликовано</th>
                        <th>Вывод на главной</th>
                        <th>Изображение</th>
                        <th style="width: 100px">Действие</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
