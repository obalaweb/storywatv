@props(['posts'])

<div class="related-blog">
    <h3 class="related-title">You May Also Like</h3>
    <div class="wrap-element">
        <div class="list-posts">
            <div class="slide-posts js-call-slick-col">
                @foreach ($posts as $related)
                    <div class="item-slick">
                        <div class="post-item">
                            <div class="pic">
                                <img src="{{ $related->feature_photo ?? asset('assets/images/post-01.jpg') }}"
                                    alt="{{ $related->title }}" class="img-fluid">
                                <div class="overlay"></div>
                                <div class="meta-info">
                                    <div class="imdb"><span class="value">{{ $related->views ?? 0 }}</span>Views
                                    </div>
                                    <div class="label" style="background: #e40914;">New</div>
                                </div>
                                <a href="{{ route('blog.show', $related->slug) }}" class="btn-play"></a>
                            </div>
                            <h4 class="title">
                                <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                            </h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .related-blog {
        margin-top: 40px;
    }

    .related-title {
        font-size: 1.8rem;
        margin-bottom: 20px;
    }

    .post-item {
        text-align: center;
    }

    .post-item .pic {
        position: relative;
        overflow: hidden;
    }

    .post-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .post-item:hover img {
        transform: scale(1.05);
    }

    .post-item .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
    }

    .meta-info {
        position: absolute;
        bottom: 10px;
        left: 10px;
        color: white;
    }

    .imdb {
        margin-bottom: 5px;
    }

    .label {
        background: #e40914;
        padding: 2px 8px;
        border-radius: 3px;
    }

    .btn-play {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
    }

    .btn-play:before {
        content: '\25B6';
        color: #333;
        font-size: 20px;
        line-height: 40px;
        margin-left: 5px;
    }

    .post-item .title a {
        font-size: 1.1rem;
        color: #2c3e50;
        text-decoration: none;
    }

    .post-item .title a:hover {
        color: #007bff;
    }
</style>
