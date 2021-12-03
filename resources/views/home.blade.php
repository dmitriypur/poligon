@extends('layouts.main')

@section('content')
    <section class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <img style="height: 400px;object-fit: cover;"
                             src="https://tyumen.snmash.ru/images/products/opory-truboprovodov/seria-5.905-25.05-vipusk-1/no-foto.jpg"
                             class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $favorite->title ?? '' }}</h5>
                            <p class="card-text">{{ $favorite->preview ?? '' }}.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3>Categories</h3>
                    <div class="list-group mb-5" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list"
                           data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">Home</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list"
                           href="#list-profile" role="tab" aria-controls="list-profile">Profile</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list"
                           href="#list-messages" role="tab" aria-controls="list-messages">Messages</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list"
                           href="#list-settings" role="tab" aria-controls="list-settings">Settings</a>
                    </div>
                    <h3>Tags</h3>
                    <a href="#list-settings" class="btn btn-primary btn-sm">tag</a>
                    <a href="#list-settings" class="btn btn-primary btn-sm">tag</a>
                    <a href="#list-settings" class="btn btn-primary btn-sm">tag</a>
                    <a href="#list-settings" class="btn btn-primary btn-sm">tag</a>
                    <a href="#list-settings" class="btn btn-primary btn-sm">tag</a>
                    <a href="#list-settings" class="btn btn-primary btn-sm">tag</a>
                    <a href="#list-settings" class="btn btn-primary btn-sm">tag</a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <h1 class="text-center">Последние записи</h1>
            <div class="row my-5">
                @foreach($posts as $post)
                    <div class="col-md-4 mb-5">
                        <div class="card">
                            <img
                                src="https://tyumen.snmash.ru/images/products/opory-truboprovodov/seria-5.905-25.05-vipusk-1/no-foto.jpg"
                                class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->preview }}</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
