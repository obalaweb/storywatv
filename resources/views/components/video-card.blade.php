@props(['class' => '', 'title' => '', 'image'])

<div class="post-item {{$class}}">
    <a href="javascript:;">
        <img src="{{$image}}" alt="IMG"></a>

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
            <a href="https://www.youtube.com/watch?v=NEqtQYxzQaE" class="btn-play popup-youtube">
                The City Truck
            </a>

        </h4>
        {{ $slot}}
    </div>
</div>
