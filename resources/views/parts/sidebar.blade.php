<div class="sidebar_menu-auth">
    @guest()
        <a href="#" class="modal__show link_auth" data-modal="#sign-in1"></a>
    @endguest
    <a href="{{ route('cabinet') }}" class="t_green">
        Личный кабинет
    </a>
    <a href="{{ route('subscriptions') }}">
        Подписки
    </a>
    <a href="#" class="modal__show" data-modal="#sign-in2">
        Заметки
    </a>
    <a href="#" class="modal__show" data-modal="#sign-in2">
        Лента
    </a>
    <a href="#" class="modal__show" data-modal="#sign-in2">
        Рейтинг
    </a>
    <a href="{{ route('posts.create') }}" class="t_green">
        Написать статью
    </a>
</div>
<h3>Категории</h3>
<ul class="list-group mb-5">
    @foreach($categories as $category)
        <a href="{{ route('category.single', $category->slug) }}">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $category->title }}
                <span class="badge bg-primary rounded-pill">{{ $category->posts_count }}</span>
            </li>
        </a>
    @endforeach
    <a href="{{ route('categories') }}" class="t_green">Все категории...</a>
</ul>
<h3>Tags</h3>
@foreach($tags as $tag)
    <a href="{{ route('tag.single', $tag->slug) }}" class="btn btn-primary btn-sm">{{ $tag->title }}</a>
@endforeach
