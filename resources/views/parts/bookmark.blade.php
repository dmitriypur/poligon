@auth()
    <form class="add-like" action="{{ route('post.bookmark.store', $post->id) }}"
          method="post">
        @csrf
        <button type="submit" class="like-btn text-primary" data-ico="bookmark"
                data-like="0">
            @if(auth()->user()->bookmarkPosts->contains($post->id))
                <i class="fas fa-bookmark"></i>
            @else
                <i class="far fa-bookmark"></i>
            @endif
        </button>
    </form>
@endauth
@guest()
    <div>
        <i class="far fa-bookmark"></i>
    </div>
@endguest
