@foreach($items as $item)
    <li id="li-comment-{{$item->id}}" class="comment">
        <div id="comment-{{$item->id}}" class="comment-container">
            <div class="comment-author vcard">
                <p class="fn">{{$item->user->name}}</p>
            </div>
            <!-- .comment-author .vcard -->
            <div class="comment-meta commentmetadata">
                <div class="intro">
                    <div class="commentDate">
                        {{ is_object($item->created_at) ? $item->created_at->format('d.m.Y в H:i') : ''}}
                    </div>
                </div>
                <div class="comment-body">
                    <p>{{ $item->message }}</p>
                </div>
                <div class="reply group">
                    <a class="comment-reply-link" data-id="{{$item->id}}" href="#respond">Ответить</a>
                </div>
            </div>
        </div>
        @if(isset($com[$item->id]))
            <ul class="children">
                @include('frontend.comments.comment', ['items' => $com[$item->id]])
            </ul>
        @endif
    </li>
@endforeach
