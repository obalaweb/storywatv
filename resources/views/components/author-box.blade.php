@props(['author'])


<div class="author-blog">
    <div class="pic-author">
        <div class="ava-author">
            <a href="#">
                <img src="{{ asset('assets/images/ava-01.jpg') }}" alt="{{ 'author->name' }}">
            </a>
        </div>
        <div class="socials-author">
            @if ($author->facebook ?? false)
                <a href="{{ $author->facebook }}" class="item-social"><i class="ion ion-social-facebook"></i></a>
            @endif
            @if ($author->twitter ?? false)
                <a href="{{ $author->twitter }}" class="item-social"><i class="ion ion-social-twitter"></i></a>
            @endif
        </div>
    </div>
    <div class="text-author">
        <div class="name-author">
            <a href="#">{{ $author->name ?? 'Author' }}</a>
        </div>
        <div class="info-author">{{ $author->bio ?? 'Content Creator' }}</div>
        <div class="content-author">{{ Str::limit($author->description ?? 'No description available.', 100) }}</div>
    </div>
</div>

<style>
    .author-blog {
        display: flex;
        gap: 20px;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 8px;
        margin: 20px 0;
    }

    .pic-author {
        flex: 0 0 auto;
    }

    .ava-author img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
    }

    .socials-author {
        margin-top: 10px;
        text-align: center;
    }

    .text-author {
        flex: 1;
    }

    .name-author a {
        font-size: 1.5rem;
        color: #2c3e50;
        text-decoration: none;
    }

    .name-author a:hover {
        color: #007bff;
    }

    .info-author {
        color: #666;
        font-style: italic;
    }

    .content-author {
        color: #777;
    }
</style>
