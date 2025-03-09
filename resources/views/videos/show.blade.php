<x-guest-layout>
    <div id="main-content" style="background-color: #fff">
        <div class="content-area">
            <div class="page-title">
                <div class="main-top" style="background-image: url({{ asset('assets/images/bg-page-title-04.jpg') }});">
                    <div class="overlay-top-header"></div>

                    <div class="content container">

                    </div>
                </div>
            </div>

            <div class="site-content layout-2">
                <div class="container">
                    <div class="row">
                        <main class="site-main col-12">
                            <div class="wrap-main-content">
                                <!-- Block video-detail -->
                                <div class="bl-video-detail">
                                    <div class="player-video">
                                        <div class="bg-video">
                                            <iframe id="Player-1youtube" frameborder="0" allowfullscreen="1"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                title="YouTube video player" width="100%" height="660px"
                                                src="https://www.youtube.com/embed/{{ $video->youtube_id }}"></iframe>
                                        </div>
                                    </div>
                                    <div class="detail-video">
                                        <div class="info-detail sticky-sidebar">
                                            <div class="inner-info">
                                                <div class="media-video">
                                                    <div class="pic-video">
                                                        <img src="{{ asset('assets/images/product-05.jpg') }}"
                                                            alt="IMG">
                                                    </div>

                                                    <div class="meta-info">
                                                        <div class="imdb">
                                                            <span class="value">5</span>IMDb
                                                        </div>

                                                        <div class="label">
                                                            HD
                                                        </div>
                                                    </div>

                                                    <div class="more-info">
                                                        <span class="item-info">
                                                            Rating:
                                                            <i class="ion ion-android-star"></i>
                                                            8/10
                                                        </span>

                                                        <span class="item-info">
                                                            <i class="ion ion-eye"></i>
                                                            240 Views
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="info-video">
                                                    <div class="item-info">
                                                        <span class="name-item">
                                                            Actors:
                                                        </span>

                                                        <span class="value-item">
                                                            Julia Toufis
                                                        </span>
                                                    </div>

                                                    <div class="item-info">
                                                        <span class="name-item">
                                                            Writer:
                                                        </span>

                                                        <span class="value-item">
                                                            Noah
                                                        </span>
                                                    </div>

                                                    <div class="item-info">
                                                        <span class="name-item">
                                                            Release Date:
                                                        </span>

                                                        <span class="value-item">
                                                            May 12, 2018
                                                        </span>
                                                    </div>

                                                    <div class="item-info">
                                                        <span class="name-item">
                                                            Genres:
                                                        </span>

                                                        <span class="value-item">
                                                            Action
                                                        </span>
                                                    </div>

                                                    <div class="item-info">
                                                        <span class="name-item">
                                                            Country:
                                                        </span>

                                                        <span class="value-item">
                                                            USA
                                                        </span>
                                                    </div>

                                                    <div class="item-info">
                                                        <span class="name-item">
                                                            Runtime:
                                                        </span>

                                                        <span class="value-item">
                                                            60 min
                                                        </span>
                                                    </div>

                                                    <div class="item-info">
                                                        <span class="name-item">
                                                            Language:
                                                        </span>

                                                        <span class="value-item">
                                                            English
                                                        </span>
                                                    </div>

                                                    <div class="item-info">
                                                        <span class="name-item">
                                                            Type:
                                                        </span>

                                                        <span class="value-item">
                                                            Short
                                                        </span>
                                                    </div>
                                                </div>

                                                <a href="javascript:;" class="btn-watch btn-normal shape-round">
                                                    watch video
                                                </a>
                                            </div>
                                        </div>

                                        <div class="content-detail">
                                            <div class="field-detail">
                                                <h3 class="title-field">
                                                    {{ $video->title }}
                                                </h3>

                                                <div class="content-field">
                                                    {!! $video->description !!}
                                                </div>
                                            </div>

                                            <div class="field-detail">
                                                <h3 class="title-field">
                                                    Video & Photo
                                                </h3>

                                                <div class="content-field">
                                                    <div class="slide-images js-call-slick-col" data-numofshow="1"
                                                        data-numofscroll="1" data-loopslide="1" data-autoscroll="0"
                                                        data-speedauto="6000"
                                                        data-responsive="[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]">

                                                        <div class="wrap-arrow-slick">
                                                            <div class="arow-slick prev-slick">
                                                                <i class="ion ion-ios-arrow-left"></i>
                                                            </div>

                                                            <div class="arow-slick next-slick">
                                                                <i class="ion ion-ios-arrow-right"></i>
                                                            </div>
                                                        </div>

                                                        <div class="slide-slick">
                                                            <div class="item-slick">
                                                                <div class="item-img">
                                                                    <img src="{{ asset('assets/images/video-detail-02.jpg') }}"
                                                                        alt="IMG">
                                                                </div>
                                                            </div>

                                                            <div class="item-slick">
                                                                <div class="item-img">
                                                                    <img src="{{ asset('assets/images/video-detail-02.jpg') }}"
                                                                        alt="IMG">
                                                                </div>
                                                            </div>

                                                            <div class="item-slick">
                                                                <div class="item-img">
                                                                    <img src="{{ asset('assets/images/video-detail-02.jpg') }}"
                                                                        alt="IMG">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tags & share -->
                                            <div class="entry-tag-share">
                                                <div class="tags-links">
                                                    <span class="name-field">Tags:</span>
                                                    @if (isset($video->tags) && count($video->tags) > 0)
                                                        @foreach ($video->tags as $tag)
                                                            <a href="javascript:;"
                                                                class="tag-item">{{ $tag->name }}</a>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <div class="share-video">
                                                    <span class="name-field">SHARE:</span>
                                                    <a href="javascript:;" class="share-item">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>

                                                    <a href="javascript:;" class="share-item">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>

                                                    <a href="javascript:;" class="share-item">
                                                        <i class="fa fa-pinterest-p"></i>
                                                    </a>

                                                    <a href="javascript:;" class="share-item">
                                                        <i class="fa fa-linkedin"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <!-- Navigate -->
                                            <div class="navigate-blog">
                                                @if (isset($previousVideo))
                                                    <div class="navi-item prev-blog">
                                                        <a href="javascript:;" class="navi-arrow">
                                                            <i class="ion ion-ios-arrow-thin-left"></i>
                                                        </a>

                                                        <div class="navi-text">
                                                            <div class="name-navi">
                                                                PREVIOUS
                                                            </div>

                                                            <div class="title-navi">
                                                                <a
                                                                    href="{{ route('videos.show', $previousVideo->youtube_id) }}">
                                                                    {{ $previousVideo->title }}
                                                                </a>
                                                            </div>

                                                            <div class="info-navi">
                                                                {{ $previousVideo->created_at }}
                                                                {{-- October 15, 2018 --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (isset($nextVideo))
                                                    <div class="navi-item next-blog">
                                                        <div class="navi-text">
                                                            <div class="name-navi">
                                                                Next
                                                            </div>

                                                            <div class="title-navi">
                                                                <a
                                                                    href="{{ route('videos.show', $nextVideo->youtube_id) }}">
                                                                    {{ $nextVideo->title }}
                                                                </a>
                                                            </div>

                                                            <div class="info-navi">
                                                                {{ $nextVideo->created_at }}
                                                                {{-- October 15, 2018 --}}
                                                            </div>
                                                        </div>

                                                        <a href="javascript:;" class="navi-arrow">
                                                            <i class="ion ion-ios-arrow-thin-right"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="related-blog">
                                                <h3 class="related-title">
                                                    You May Also Like
                                                </h3>

                                                <div class="wrap-element">
                                                    <div class="list-posts">
                                                        <div class="slide-posts js-call-slick-col" data-numofshow="3"
                                                            data-numofscroll="1" data-loopslide="1"
                                                            data-autoscroll="0" data-speedauto="6000"
                                                            data-responsive="[3, 1], [3, 1], [2, 1], [2, 1], [1, 1]">
                                                            <div class="wrap-arrow-slick">
                                                                <div class="arow-slick prev-slick">
                                                                    <i class="ion ion-chevron-left"></i>
                                                                </div>

                                                                <div class="arow-slick next-slick">
                                                                    <i class="ion ion-chevron-right"></i>
                                                                </div>
                                                            </div>

                                                            <div class="slide-slick">
                                                                @foreach ($relatedVideos as $rVideo)
                                                                    <div class="item-slick">
                                                                        <div class="post-item">
                                                                            <div class="pic">
                                                                                <img src="{{ $rVideo->thumbnail ? $rVideo->thumbnail->url : '' }}"
                                                                                    alt="IMG">

                                                                                <div class="overlay"></div>

                                                                                <div class="meta-info">
                                                                                    <div class="imdb">
                                                                                        <span
                                                                                            class="value">5</span>IMDb
                                                                                    </div>

                                                                                    <div class="label"
                                                                                        style="background: #e40914;">
                                                                                        Hot
                                                                                    </div>
                                                                                </div>

                                                                                <a href="https://www.youtube.com/watch?v={{ $rVideo->youtube_id }}"
                                                                                    class="btn-play popup-youtube"></a>
                                                                            </div>

                                                                            <h4 class="title">
                                                                                <a
                                                                                    href="{{ route('videos.show', $rVideo->youtube_id) }}">
                                                                                    {{ $rVideo->title }}
                                                                                </a>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end Block video-detail -->
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
