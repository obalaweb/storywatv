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
                    <div class="slide-posts js-call-slick-col" data-numofshow="4" data-numofscroll="1" data-loopslide="1"
                        data-autoscroll="0" data-speedauto="6000"
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
                                                        <img src="assets/images/bg-featurepost-03.jpg" alt="IMG">
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
