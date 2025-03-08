@props(['videos'])

<div class="bp-element bp-element-st-list-videos vblog-layout-slider-4">
    <div class="wrap-element">
        <div class="slide-videos js-call-slick-col">
            @foreach ($videos as $video)
                <div class="item-slick">
                    <div class="item-video">
                        <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" class="img-fluid">
                        <a href="{{ $video['url'] }}" class="btn-play popup-youtube"></a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="wrap-dot-slick"></div>
    </div>
</div>

<style>
    .bp-element-st-list-videos .item-video {
        position: relative;
    }

    .bp-element-st-list-videos img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .bp-element-st-list-videos .btn-play {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bp-element-st-list-videos .btn-play:before {
        content: '\25B6';
        color: white;
        font-size: 30px;
        margin-left: 5px;
    }
</style>
