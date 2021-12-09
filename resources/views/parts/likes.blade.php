<form class="add-like" action="{{ route('post.like.store', $post->id) }}"
      method="post">
    @csrf
    <span class="text-primary like-count">{{ $post->likes_count }}</span>
    <button type="submit" class="like-btn text-primary" data-ico="heart" data-like="0">
        @if($post->likes->contains('user_ip', $post->ipUser()))
            <i class="fas fa-heart"></i>
        @else
            <i class="far fa-heart"></i>
        @endif
    </button>
</form>
