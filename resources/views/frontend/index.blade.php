<x-guest-layout>
    <div id="main-content" style="background: #1e1e1e;">
        <!-- Banner home-1 -->
        <div class="thim-banner_home-1" style="background-image: url(assets/images/gulu.jpg);">
            <div class="overlay-area"></div>

            <div class="container">
                <!-- shortcode st-list-videos -->
                <div class="bp-element bp-element-st-list-videos vblog-layout-1">
                    <div class="wrap-element">
                        <div class="feature-item">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="video">
                                        <div id="play"></div>
                                        <span id="videoId" class="d-none">{{ $featuredVideo->youtube_id }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end shortcode st-list-videos -->

                <!-- shortcode st-list-videos -->
                <div class="bp-element bp-element-st-list-videos vblog-layout-1-1">
                    <div class="wrap-element">
                        <div class="normal-items">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text">
                                        <h1 class="title">
                                            <a href="#" style="color:white; font-size: 20px;">
                                                {{ $featuredVideo->title }}
                                            </a>
                                        </h1>
                                        <div class="description">
                                            {{ $featuredVideo->short_description }}
                                        </div>

                                        <a href="{{ route('videos.show', $featuredVideo->youtube_id) }}"
                                            class="btn-readmore btn-normal shape-round">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end shortcode st-list-videos -->
            </div>
        </div>
        <!-- end Banner home-1 -->

        <!-- Popular video home-1 -->
        <div class="thim-popular-video_home-1">
            <div class="container">
                <!-- shortcode st-list-videos -->
                <div class="bp-element bp-element-st-list-videos vblog-layout-slider-1">
                    <div class="wrap-element">
                        <div class="heading-post">
                            <h3 class="title">
                                popular videos
                            </h3>

                            <a href="#" class="link">
                                See all news
                            </a>
                        </div>

                        <div class="list-posts">
                            <div class="slide-posts js-call-slick-col" data-numofshow="4" data-numofscroll="1"
                                data-loopslide="1" data-autoscroll="0" data-speedauto="6000"
                                data-responsive="[4, 1], [4, 1], [3, 1], [2, 1], [1, 1]">
                                <div class="wrap-arrow-slick">
                                    <div class="arow-slick prev-slick">
                                        <i class="ion ion-ios-arrow-left"></i>
                                    </div>

                                    <div class="arow-slick next-slick">
                                        <i class="ion ion-ios-arrow-right"></i>
                                    </div>
                                </div>

                                <div class="slide-slick">
                                    @foreach ($videos as $video)
                                        <x-video :video="$video" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end shortcode st-list-videos -->
            </div>
        </div>
        <!-- end Popular video home-1 -->

        <!-- Ads home-1 -->
        <x-ads-card />
        <!-- end Ads home-1 -->

        <!--6 home-1 -->
        <div class="thim-trending-categories_home-1">
            <div class="container">
                <!-- shortcode st-list-categories -->
                <div class="bp-element bp-element-st-list-categories vblog-layout-slider-1">
                    <div class="wrap-element">
                        <div class="heading-post">
                            <div class="text">
                                <h3 class="title">
                                    TRENDING CATEGORIES
                                </h3>

                                <div class="description">
                                    It is a long established fact that a reader
                                </div>
                            </div>
                        </div>

                        <div class="list-posts">
                            <div class="slide-posts js-call-slick-col" data-numofshow="3" data-numofscroll="1"
                                data-loopslide="1" data-autoscroll="0" data-speedauto="6000"
                                data-responsive="[3, 1], [3, 1], [2, 1], [2, 1], [1, 1]">
                                <div class="wrap-arrow-slick">
                                    <div class="arow-slick prev-slick">
                                        <i class="ion ion-ios-arrow-left"></i>
                                    </div>

                                    <div class="arow-slick next-slick">
                                        <i class="ion ion-ios-arrow-right"></i>
                                    </div>
                                </div>

                                <div class="slide-slick">
                                    @foreach ($categories as $category)
                                        <x-category-card :category="$category" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end shortcode st-list-categories -->
            </div>
        </div>
        <!-- end Trending categories home-1 -->

        <!-- Latest video home-1 -->
        <div class="thim-latest-video_home-1">
            <div class="container">
                <!-- shortcode st-list-videos -->
                <div class="bp-element bp-element-st-list-videos vblog-layout-grid-1">
                    <div class="wrap-element">
                        <div class="heading-post">
                            <div class="wrap-title">
                                <h3 class="title">
                                    LATEST VIDEOS
                                </h3>

                                <a href="javascript:;" class="link">
                                    All Videos
                                </a>
                            </div>

                            <div class="categories">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li class="current-cat">
                                            <a href="javascript:;">
                                                {{ str($category->name)->upper() }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="grid-posts grid-isotope">
                            <div class="grid-sizer"></div>

                            @isset($featuredVideo)
                                <div class="grid-item size_2x2">
                                    <x-video-card :video="$featuredVideo" class="feature-item"
                                        image="assets/images/bg-featurepost-02.jpg">
                                        <div class="info">
                                            <span>BY {{ $featuredVideo->postBy->name }}</span>
                                            <span>{{ $featuredVideo->postedOn }}</span>
                                        </div>

                                        <div class="description">
                                            {{ $featuredVideo->short_description }}
                                        </div>

                                        <a href="{{ route('videos.show', $featuredVideo->youtube_id) }}"
                                            class="btn-readmore btn-small shape-round">
                                            read more
                                        </a>
                                    </x-video-card>
                                </div>
                            @endisset

                            @foreach ($otherVideos as $video)
                                <div class="grid-item">
                                    <x-video-card :video="$video" image="assets/images/post-08.jpg" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- end shortcode st-list-videos -->
            </div>
        </div>
        <!-- end Latest video home-1 -->

        <!-- Ads home-1 -->
        <x-ads-card />
        <!-- end Ads home-1 -->

        <!-- News feed home-1 -->
        <div class="thim-news-feed_home-1">
            <div class="container">
                <!-- shortcode posts -->
                <div class="bp-element bp-element-posts vblog-layout-slider-3">
                    <div class="wrap-element">
                        <div class="heading-post">
                            <h3 class="title">
                                News Feed
                            </h3>

                            <div class="description">
                                It is a long established fact that a reader
                            </div>
                        </div>
                        <div class="list-posts">
                            <div class="slide-posts js-call-slick-col" data-numofshow="1" data-numofscroll="1"
                                data-loopslide="1" data-autoscroll="0" data-speedauto="6000"
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

                                    @foreach ($posts as $post)
                                        <div class="item-slick">
                                            <div class="post-item">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="feature-item">
                                                            <a #">
                                                                <img src="assets/images/bg-featurepost-03.jpg"
                                                                    alt="IMG">
                                                            </a>

                                                            <div class="overlay"></div>

                                                            <div class="content">
                                                                <h4 class="title">
                                                                    <a #">
                                                                        6 Products Designed to Make Trend Ombré Makeup
                                                                        Simple
                                                                    </a>
                                                                </h4>

                                                                <div class="info">
                                                                    <span class="item-info">BY <a
                                                                            href="javascript:;">POLLY</a></span>
                                                                    <span class="item-info">MAY 1, 2018</span>
                                                                    <span class="item-info">Animation</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <x-post-card />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end shortcode posts -->
            </div>
        </div>
        <!-- end News feed home-1 -->
    </div>
    @section('scripts')
        <script src="https://www.youtube.com/iframe_api"></script>
        <script>
            let player;
            let checkInterval;

            function onYouTubeIframeAPIReady() {
                const videoId = document.getElementById('videoId').textContent;

                player = new YT.Player('play', {
                    videoId: videoId,
                    width: '100%',
                    height: '580',
                    playerVars: {
                        autoplay: 1,
                        mute: 1, // Ensures autoplay works on mobile
                        modestbranding: 1
                    },
                    events: {
                        onReady: onPlayerReady,
                        onStateChange: onPlayerStateChange
                    }
                });
            }

            function onPlayerReady(event) {
                event.target.playVideo();
                startTimeCheck();
            }

            function onPlayerStateChange(event) {
                if (event.data === YT.PlayerState.PLAYING) {
                    startTimeCheck();
                } else if (event.data === YT.PlayerState.PAUSED || event.data === YT.PlayerState.ENDED) {
                    clearInterval(checkInterval);
                }
            }

            function startTimeCheck() {
                // Clear any existing interval to prevent multiple timers
                clearInterval(checkInterval);

                // Check every half second
                checkInterval = setInterval(() => {
                    const currentTime = player.getCurrentTime();
                    const duration = player.getDuration();
                    const timeLeft = duration - currentTime;

                    // Switch video when 2 seconds remain
                    if (timeLeft <= 2 && timeLeft > 0) {
                        clearInterval(checkInterval);
                        playNextVideo();
                    }
                }, 500); // 500ms = 0.5 seconds polling interval
            }

            async function playNextVideo() {
                try {
                    const response = await fetch("/play-next");

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const data = await response.json();

                    if (data.videoId) {
                        player.loadVideoById(data.videoId);
                    } else {
                        console.error("No next video ID received.");
                    }
                } catch (error) {
                    console.error("Error fetching next video:", error);
                }
            }
        </script>
    @endsection

</x-guest-layout>
