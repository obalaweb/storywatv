@props(['previous' => null, 'next' => null])

<div class="navigate-blog">
    @if ($previous)
        <div class="navi-item prev-blog">
            <a href="{{ route('blog.show', $previous->slug) }}" class="navi-arrow">
                <i class="ion ion-ios-arrow-thin-left"></i>
            </a>
            <div class="navi-text">
                <div class="name-navi">PREVIOUS</div>
                <div class="title-navi"><a href="{{ route('blog.show', $previous->slug) }}">{{ $previous->title }}</a>
                </div>
                <div class="info-navi">{{ $previous->formattedPublishedDate() }}</div>
            </div>
        </div>
    @endif
    @if ($next)
        <div class="navi-item next-blog">
            <div class="navi-text">
                <div class="name-navi">NEXT</div>
                <div class="title-navi"><a href="{{ route('blog.show', $next->slug) }}">{{ $next->title }}</a></div>
                <div class="info-navi">{{ $next->formattedPublishedDate() }}</div>
            </div>
            <a href="{{ route('blog.show', $next->slug) }}" class="navi-arrow">
                <i class="ion ion-ios-arrow-thin-right"></i>
            </a>
        </div>
    @endif
</div>

<style>
    .navigate-blog {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
    }

    .navi-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .navi-arrow {
        font-size: 2rem;
        color: #007bff;
        text-decoration: none;
    }

    .navi-text {
        flex: 1;
    }

    .name-navi {
        font-size: 0.9rem;
        color: #666;
        text-transform: uppercase;
    }

    .title-navi a {
        font-size: 1.2rem;
        color: #2c3e50;
        text-decoration: none;
    }

    .title-navi a:hover {
        color: #007bff;
    }

    .info-navi {
        color: #777;
    }
</style>
