@extends('admin.layouts.main')
@section('content')
    <div class="container">
        <h1 class="my-5">Понравившиеся записи</h1>

        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Название</th>
                        <th style="width: 100px">Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                <a href="{{ route('show.post', $post->slug) }}">
                                    {{ $post->title ?? '' }}
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('bookmark.delete', $post->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="2">
                                <h3>Записи отсутствуют</h3>
                            </th>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Название</th>
                        <th style="width: 100px">Удалить</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
