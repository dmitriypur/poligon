<h2>{{ $title }}</h2>

@isset($category)
    <div class="cat-desc mb-5">
        <img class="w-25 h-25 float-start d-block me-3 mb-3" src="{{ $category->getImage() ?? '' }}"
             alt="{{ $category->title ?? '' }}">
        <p class="card-text">{{ $category->description ?? '' }}</p>
    </div>
@endisset

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
</nav>

<div id="post-data">
    @include('parts.data')
</div>


<div class="ajax-load text-center" style="display: none;">
    <p><img src="{{ asset('preload.gif') }}" alt="preload"></p>
</div>

@section('scripts')
    <script>
        let lastPage = {{ $posts->lastPage() }};
    </script>
@endsection
