@extends('admin.layouts.main')
@section('content')
    <div class="container">
        <h1 class="my-5">Тэги</h1>
        <a href="{{ route('tag.create') }}" class="btn btn-primary mb-3">Создать тэг</a>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Название</th>
                        <th style="width: 100px">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->title ?? '' }}</td>
                            <td>
                                <a href="{{ route('tag.edit', $tag->id) }}" class="btn btn-primary btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <form action="{{ route('tag.destroy', $tag->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="2">
                                <h1>Тэги отсутствуют</h1>
                            </th>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $tags->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
