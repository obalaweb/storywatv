<x-guest-layout>
    <div id="main-content">
        <div class="content-area">
            <x-banner title="Blog" />

            <div class="site-content sidebar-right layout-1">
                <div class="container">
                    <div class="row">
                        <main class="site-main col-lg-9">
                            <div class="wrap-main-content">
                                <!-- Block list blogs -->
                                @foreach ($posts as $post)
                                    <div class="blog-list thim-1-col vblog-layout-1">
                                        <article class="item-blog image-item">
                                            <div class="media-item">
                                                <div class="pic">
                                                    <a href="{{ route('blog.show', $post->slug) }}">
                                                        <img src="assets/images/blog-01.jpg" alt="IMG">
                                                    </a>
                                                </div>

                                                <div class="date">
                                                    <span class="number">08</span> AUG, 2018
                                                </div>
                                            </div>

                                            <div class="text-item">
                                                <h4 class="title">
                                                    <a href="{{ route('blog.show', $post->slug) }}" class="text-white">
                                                        {{ $post->title }}
                                                    </a>
                                                </h4>

                                                <div class="info">
                                                    <span class="info-item">
                                                        <i class="ion ion-android-person"></i>
                                                        By <a href="javascript:;">Thomas Doe</a>
                                                    </span>

                                                    <span class="info-item">
                                                        <i class="ion ion-ios-pricetags-outline"></i>
                                                        <a href="javascript:;">Academics,</a>
                                                        <a href="javascript:;">Design</a>
                                                    </span>

                                                    <span class="info-item">
                                                        <i class="ion ion-android-chat"></i>
                                                        (0)
                                                        Comment
                                                    </span>
                                                </div>

                                                <div class="content">
                                                    It is a long established fact that a reader will be distracted by
                                                    the
                                                    readable content of a page when looking at its layout. The point of
                                                    using Lorem Ipsum is that it has a more-or-less normal distribution
                                                    of
                                                    letters, as opposed to using 'Content here, content here',
                                                </div>

                                                <a href="{{ route('blog.show', $post->slug) }}"
                                                    class="btn-learnmore btn-small shape-round">
                                                    read more
                                                </a>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                                <!-- end Block list blogs -->

                                <ul class="loop-pagination">
                                    <li>
                                        <a href="javascript:;" class="page-numbers">
                                            1
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </main>

                        <div class="widget-area col-sm-9 col-md-8 col-lg-3 sticky-sidebar">
                            <livewire:sidebar />
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-guest-layout>
