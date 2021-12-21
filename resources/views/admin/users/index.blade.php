@extends('admin.layouts.main')
@section('content')
    <div class="container">
        <h1 class="my-5">Пользователи</h1>
        <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Создать пользователя</a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Пользователи</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Статус</th>
                                <th style="width: 130px">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-{{ $user->is_admin ? 'success' : 'primary' }}">{{ $user->is_admin ? 'администратор' : 'пользователь' }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $users->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
