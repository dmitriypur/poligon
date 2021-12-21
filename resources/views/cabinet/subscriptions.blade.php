@extends('layouts.main')

@section('content')
    <div class="row">
        <ul class="col-md-3">
            @include('parts.sidebar')
        </ul>
        <div class="col-md-9">
            <h1>Подписки</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                            <th>Авторы</th>
                            <th> </th>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td clphpass="table-text"><div>{{ $user->name }}</div></td>
                                    @if (auth()->user()->isFollowing($user->id))
                                        <td>
                                            <form action="{{route('user.unfollow', $user->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" id="delete-follow-{{ $user->id }}" class="btn btn-danger">
                                                    Отписаться
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
