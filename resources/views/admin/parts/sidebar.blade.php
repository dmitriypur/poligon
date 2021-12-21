<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <span class="brand-text font-weight-light">На сайт</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->getImage() }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Главная</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('post.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Записи
                            <span class="badge badge-info right">{{ $postsCount }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                            Категории
                            <span class="badge badge-info right">{{ $categoriesCount }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tag.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Тэги
                            <span class="badge badge-info right">{{ $tagsCount }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Пользователи
                            <span class="badge badge-info right">{{ $usersCount }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('bookmark') }}" class="nav-link">
                        <i class="nav-icon fas fa-bookmark"></i>
                        <p>
                            Закладки
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reklama.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Реклама
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('comment.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            Комментарии
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
