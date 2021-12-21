@if($posts->total() > 0)
    <?php
    if (!isset($currentPage)) {
        $currentPage = 0;
    }
    $i = $currentPage;
    ?>
    @foreach($posts as $k => $post)
        <div class="card mb-5" data-post="{{ $k }}">
            <img src="{{ $post->getImage() }}"
                 class="card-img-top" alt="{{ $post->title }}">
            <div class="card-body">
                <span class="post-date">{{ $post->dateAsCarbon }}</span>
                <h5 class="card-title">{{ $post->title }}</h5>
                @include('parts.likes')
                <a href="{{ route('show.post', $post->slug) }}" class="btn btn-primary">Далее</a>
                <p><i class="far fa-eye"></i> <span class="badge bg-primary">{{ $post->view_count }}</span></p>
            </div>
        </div>

        @isset($reklama)
            @if(($k + 1) % 3 == 0 && $reklama->count())
                @if($reklama[$i]->publish)
                    <a href="{{ $reklama[$i]['link'] }}" class="text-white">
                        <div class="card mb-5 p-5" data-post="{{ $k }}"
                             style="background: url('{{ $reklama[$i]->getImage() }}') no-repeat center/cover">
                            <div class="card-body">
                                <h5 class="card-title">{{ $reklama[$i]['title'] }}</h5>
                            </div>
                        </div>
                    </a>
                @endif
                @if($i < $reklama->count() ? $i++ : $i = 0) @endif
            @endif
        @endisset
    @endforeach
@endif

