@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <h1 class="my-5">Записи</h1>
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Название</th>
                        <th style="width: 100px">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($trash_posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title ?? '' }}</td>
                            <td>
                                <a href="{{ route('restore.post', $post->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-undo"></i>
                                </a>
                                <form action="{{ route('delete.trash.post', $post->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="2">
                                <h3>Корзина пуста</h3>
                            </th>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
{{--                {{ $trash_posts->links('vendor.pagination.bootstrap-4') }}--}}
            </div>
        </div>
    </div>
@endsection
