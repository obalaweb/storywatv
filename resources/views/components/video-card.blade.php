@props(['class' => '', 'title' => '', 'image' => '', 'video'])


<div class="post-item {{ $class }}">
    <a href="javascript:;">
        <img src="{{ $video ? ($video->thumbnail_url ? $video->thumbnail->url : $image) : $image }}" alt="IMG"></a>

    <div class="overlay"></div>

    <div class="meta-info">
        <div class="imdb">
            <span class="value">5</span>IMDb
        </div>

        <div class="label" style="background: #ff6c00;">
            Trend
        </div>
    </div>

    <div class="content">
        <h4 class="title">
            <a href="{{ $video ? $video->youtube_url : '' }}" class="btn-play popup-youtube">
            </a>

        </h4>
        {{ $slot }}
    </div>
</div>
