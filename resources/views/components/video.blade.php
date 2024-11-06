@props(['video'])
<div class="item-slick">
    <div class="post-item">
        <div class="pic">

            <div class="image-container"
                style="display: flex; justify-content: center; align-items: center; height: 380px; width: 350px; overflow: hidden;">
                <img src="{{$video->thumbnail->url}}" style="height: 100%; width: 100%; object-fit: cover;" alt="IMG">
            </div>


            <div class="overlay"></div>

            <div class="meta-info">
                <div class="imdb">
                    <span class="value">5</span>IMDb
                </div>

                <div class="label" style="background: #F97316;">
                    Hot
                </div>
            </div>

            <a href="{{convert_youtube_link($video->youtube_url)}}" class="btn-play popup-youtube"
                style="color: #F97316; font-size: 48px;">

                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
                    <path fill="currentColor"
                        d="M133 440a35.37 35.37 0 0 1-17.5-4.67c-12-6.8-19.46-20-19.46-34.33V111c0-14.37 7.46-27.53 19.46-34.33a35.13 35.13 0 0 1 35.77.45l247.85 148.36a36 36 0 0 1 0 61l-247.89 148.4A35.5 35.5 0 0 1 133 440" />
                </svg>
            </a>
        </div>

        <h4 class="title">
            <a href="javascript:;">
                {{ $video->title }}
            </a>
        </h4>

        <div class="info">
            Action, Drama
        </div>
    </div>
</div>
