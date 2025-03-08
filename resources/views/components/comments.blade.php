@props(['comments', 'postId'])

<div class="comments-area">
    <div class="list-comments">
        <h3 class="comments-title">{{ $comments->count() }} Comment{{ $comments->count() !== 1 ? 's' : '' }}</h3>
        <ul class="comment-list">
            @foreach ($comments as $comment)
                <li class="comment">
                    <img class="avatar" src="{{ $comment->user->profile_photo ?? asset('assets/images/ava-01.jpg') }}"
                        alt="{{ $comment->user->name }}">
                    <div class="content-comment">
                        <div class="author">
                            <span class="author-name">{{ $comment->user->name }}</span>
                            <span
                                class="comment-extra-info">{{ $comment->created_at->format('F j, Y \a\t g:i A') }}</span>
                            <span class="link-reply-edit">
                                <a href="#" wire:click="reply({{ $comment->id }})"
                                    class="comment-reply-link">Reply</a>
                            </span>
                        </div>
                        <div class="message">{!! $comment->body !!}</div>
                    </div>
                    @if ($comment->children->count())
                        <ul class="children">
                            @foreach ($comment->children as $child)
                                @include('components.comments', [
                                    'comments' => collect([$child]),
                                    'postId' => $postId,
                                ])
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Comment Form -->
    {{-- <livewire:comment-form :postId="$postId" /> --}}
</div>

<style>
    .comments-area {
        margin-top: 30px;
    }

    .comments-title {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .comment-list {
        list-style: none;
        padding: 0;
    }

    .comment {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .comment .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .content-comment {
        flex: 1;
    }

    .author {
        margin-bottom: 10px;
    }

    .author-name {
        font-weight: bold;
    }

    .comment-extra-info {
        color: #666;
        margin-left: 10px;
    }

    .link-reply-edit {
        float: right;
    }

    .comment-reply-link {
        color: #007bff;
        text-decoration: none;
    }

    .comment-reply-link:hover {
        text-decoration: underline;
    }

    .message {
        color: #777;
    }

    .children {
        margin-left: 60px;
    }
</style>
