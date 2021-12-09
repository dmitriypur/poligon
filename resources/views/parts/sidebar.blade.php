<h3>Categories</h3>
<ul class="list-group mb-5">
    @foreach($categories as $category)
        <a href="{{ route('category.single', $category->slug) }}">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $category->title }}
                <span class="badge bg-primary rounded-pill">{{ $category->posts_count }}</span>
            </li>
        </a>
    @endforeach
    <a href="{{ route('categories') }}">Все категории...</a>
</ul>
<h3>Tags</h3>
@foreach($tags as $tag)
    <a href="{{ route('tag.single', $tag->slug) }}" class="btn btn-primary btn-sm">{{ $tag->title }}</a>
@endforeach
