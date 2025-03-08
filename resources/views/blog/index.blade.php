<x-guest-layout>
    <div id="main-content">
        <div class="content-area">
            <!-- Banner -->
            <x-banner title="Blog" subtitle="Latest News & Updates" />

            <!-- Main Content -->
            <div class="site-content sidebar-right layout-1 py-5">
                <div class="container">
                    <div class="row">
                        <main class="site-main col-lg-9 col-md-8 col-sm-12">
                            <div class="wrap-main-content">
                                <!-- Blog List -->
                                @forelse($posts as $post)
                                    <div class="blog-list thim-1-col vblog-layout-1 mb-4">
                                        <article class="item-blog image-item">
                                            <div class="media-item">
                                                <div class="pic">
                                                    <a href="{{ route('blog.show', $post->slug) }}">
                                                        <img src="{{ $post->feature_image ?? asset('assets/images/blog-01.jpg') }}"
                                                            alt="{{ $post->title }}" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="date">
                                                    <span class="number">{{ $post->published_at->format('d') }}</span>
                                                    {{ $post->published_at->format('M, Y') }}
                                                </div>
                                            </div>

                                            <div class="text-item">
                                                <h4 class="title">
                                                    <a
                                                        href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                                </h4>

                                                <div class="info">
                                                    <span class="info-item">
                                                        <i class="ion ion-android-person"></i>
                                                        By <a href="#">
                                                            {{ $post->author->name ?? 'Thomas Doe' }}
                                                        </a>
                                                    </span>

                                                    <span class="info-item">
                                                        <i class="ion ion-ios-pricetags-outline"></i>
                                                        @foreach ($post->tags as $tag)
                                                            <a
                                                                href="{{ route('blog.tag', $tag) }}">{{ $tag }}</a>{{ !$loop->last ? ',' : '' }}
                                                        @endforeach
                                                    </span>

                                                    <span class="info-item">
                                                        <i class="ion ion-android-chat"></i>
                                                        ({{ $post->comments_count ?? 0 }})
                                                        Comment{{ ($post->comments_count ?? 0) !== 1 ? 's' : '' }}
                                                    </span>
                                                </div>

                                                <div class="content">
                                                    {{ Str::limit(strip_tags($post->content), 150) }}
                                                </div>

                                                <a href="{{ route('blog.show', $post->slug) }}"
                                                    class="btn-learnmore btn-small shape-round">
                                                    Read More
                                                </a>
                                            </div>
                                        </article>
                                    </div>
                                @empty
                                    <div class="text-center py-5">
                                        <p class="text-muted">No posts found.</p>
                                    </div>
                                @endforelse

                                <!-- Pagination -->
                                @if ($posts->hasPages())
                                    <div class="loop-pagination mt-4">
                                        {{ $posts->links('vendor.pagination.bootstrap-5') }}
                                    </div>
                                @endif
                            </div>
                        </main>

                        <!-- Sidebar -->
                        <aside class="widget-area col-lg-3 col-md-4 col-sm-12 sticky-sidebar">
                            <livewire:sidebar />
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
