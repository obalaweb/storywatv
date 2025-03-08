<x-guest-layout>
    <div id="main-content">
        <div class="content-area">
            <!-- Banner -->
            <x-banner :title="$post->title" :subtitle="$post->sub_title" />

            <!-- Main Content -->
            <div class="site-content sidebar-right layout-5 py-5">
                <div class="container">
                    <div class="row">
                        <main class="site-main col-lg-9 col-md-8 col-sm-12">
                            <div class="wrap-main-content">
                                <!-- Blog Detail -->
                                <div class="bl-blog-detail">
                                    <div class="head-blog">
                                        <h1 class="title-blog-detail">{{ $post->title }}</h1>
                                        <div class="info-blog-detail">
                                            <span class="info-item">
                                                <i class="ion ion-android-person"></i>
                                                By <a href="#">
                                                    {{ $post->user->name ?? 'Unknown Author' }}
                                                </a>
                                            </span>
                                            <span class="info-item">
                                                <i class="ion ion-ios-pricetags-outline"></i>
                                                @foreach ($post->tags as $tag)
                                                    <a
                                                        href="{{ route('blog.tag', $tag->slug) }}">{{ $tag->name }}</a>{{ !$loop->last ? ',' : '' }}
                                                @endforeach
                                            </span>
                                            <span class="info-item">
                                                <i class="ion ion-android-chat"></i>
                                                ({{ $post->comments->count() }})
                                                Comment{{ $post->comments->count() !== 1 ? 's' : '' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="media-blog-detail">
                                        <div class="pic">
                                            <img src="{{ $post->feature_photo ?? asset('assets/images/single-blog-01.jpg') }}"
                                                alt="{{ $post->photo_alt_text ?? $post->title }}" class="img-fluid">
                                        </div>
                                        <div class="date">
                                            <span
                                                class="number">{{ $post->published_at ? $post->published_at->format('d') : '' }}</span>
                                            {{ $post->published_at ? $post->published_at->format('M, Y') : '' }}
                                        </div>
                                    </div>

                                    <div class="text-blog-detail">
                                        <!-- Social Share -->
                                        {{-- <x-social-share :url="route('blog.show', $post->slug)" :title="$post->title" /> --}}

                                        <!-- Content -->
                                        <div class="content-blog">
                                            {!! $post->body !!}
                                        </div>

                                        <!-- Tags -->
                                        @if ($post->tags->count())
                                            <div class="tags">
                                                <span class="name-field">Tags:</span>
                                                @foreach ($post->tags as $tag)
                                                    <a href="{{ route('blog.tag', $tag->slug) }}"
                                                        class="tag-item">{{ $tag->name }}</a>
                                                @endforeach
                                            </div>
                                        @endif

                                        <!-- Author -->
                                        <x-author-box :author="$post->user" />

                                        <!-- Navigation -->
                                        <x-post-navigation :previous="$previousPost" :next="$nextPost" />

                                        <!-- Comments -->
                                        <x-comments :comments="$post->comments" :postId="$post->id" />
                                    </div>
                                </div>

                                <!-- Related Posts -->
                                <x-related-posts :posts="$post->relatedPosts()" />
                            </div>
                        </main>

                        <!-- Sidebar -->
                        <aside class="widget-area col-lg-3 col-md-4 col-sm-12 sticky-sidebar">
                            <x-blog-sidebar :categories="$categories" :popularPosts="$popularPosts" />
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/slick.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.slide-posts').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: false,
                    prevArrow: '.prev-slick',
                    nextArrow: '.next-slick',
                    responsive: [{
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            });
        </script>
    @endpush
</x-guest-layout>
