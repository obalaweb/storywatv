<x-guest-layout>
    <div id="main-content">
        <div class="content-area">
            <x-banner title="Videos" />

            <div class="site-content layout-1">
                <div class="container">
                    <div class="row">
                        <main class="site-main col-12">
                            <div class="wrap-main-content">
                                <!-- Videos list-videos-page -->
                                <div class="thim-videos_list-videos-page">
                                    <!-- Block vidoes-list -->
                                    <div class="videos-list">
                                        <div class="wrap-element js-call-isotope-filter">
                                            <div class="heading-element">
                                                <div class="wrap-filter-group">
                                                    <div class="filter-tope-group">
                                                        <span class="item-tope active text-white" data-filter="*">
                                                            All
                                                        </span>

                                                        <span class="item-tope text-white" data-filter=".Cinema">
                                                            Cinema
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="wrap-select-filter">
                                                    Year :

                                                    <div class="select-filter">
                                                        <label>
                                                            <select>
                                                                <option>All</option>
                                                                <option>2016</option>
                                                                <option>2017</option>
                                                                <option>2018</option>
                                                            </select>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="wrap-filter-videos js-filter-full-container">
                                                    <a href="javascript:;" class="toggle-filter text-white">
                                                        Filter videos
                                                    </a>

                                                    <div class="content-filter">
                                                        Filter content
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row isotope-grid">
                                                @forelse ($videos as $video)
                                                    <div
                                                        class="col-sm-6 col-md-4 col-lg-3 isotope-item Cinema Animation">
                                                        <div class="item-post">
                                                            <div class="pic-item">
                                                                <img src="{{ is_int($video->thumbnail_url) ? $video->thumbnail->url : $video->thumbnail_url }}"
                                                                    alt="IMG">

                                                                <div class="overlay"></div>

                                                                <div class="meta-info">
                                                                    <div class="imdb">
                                                                        <span class="value">5</span>IMDb
                                                                    </div>

                                                                    <div class="label" style="background: #e40914;">
                                                                        Hot
                                                                    </div>
                                                                </div>

                                                                <a href="https://www.youtube.com/watch?v=NEqtQYxzQaE"
                                                                    class="btn-play popup-youtube"></a>
                                                            </div>

                                                            <div class="text-item">
                                                                <h4 class="title">
                                                                    <a href="" class="text-white">
                                                                        {{ $video->title }}
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <p>No video found</p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end Block vidoes-list -->

                                    <ul class="loop-pagination">
                                        <li>
                                            <a href="javascript:;" class="page-numbers">
                                                1
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:;" class="page-numbers current">
                                                2
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:;" class="page-numbers">
                                                3
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:;" class="page-numbers">
                                                4
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:;" class="page-numbers next">
                                                Next
                                                <i class="ion ion-ios-arrow-thin-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end Videos list-videos-page -->
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
