<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('posts') }}">Блог</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('categories') }}">Категории</a>
                </li>
                @guest()
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login.create') }}">Вход</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register.create') }}">Регистрация</a>
                    </li>
                @endguest
                @auth()
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Выход</a>
                    </li>
                @endauth
            </ul>
            @auth()
                <div class="dropdown">
                    <a class="dropdown-link" id="notifications" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <span class="alert-count"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="notificationsMenu" id="notificationsMenu">
                        <li class="dropdown-header">Нет уведомлений</li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>
