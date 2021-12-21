@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1 class="my-5">Комментарии</h1>

        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Автор</th>
                        <th>Опубликовано</th>
                        <th>Запись</th>
                        <th style="width: 100px">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user->name ?? '' }}</td>
                            <td class="{{ $comment->publish ? 'text-success' : 'text-danger' }}">{{ $comment->publish ? 'Да' : 'Нет' }}</td>
                            <td>{{ $comment->post->title ?? '' }}</td>
                            <td>
                            <td>
                                <a href="{{ route('comment.edit', $comment) }}" class="btn btn-primary btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <form action="{{ route('comment.destroy', $comment) }}" method="post" class="d-inline">
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
                        <th>Автор</th>
                        <th>Опубликовано</th>
                        <th>Запись</th>
                        <th style="width: 100px">Действие</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
