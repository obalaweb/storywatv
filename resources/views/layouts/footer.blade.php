<footer class="site-footer layout-1">
    <div class="footer-sidebars">
        <div class="container">
            <div class="thim-3-col">
                <aside class="widget widget_thim_layout_builder">
                    <div class="wpb_single_image" style="font-size: 36px; font-weight: bolder;">
                        <span style="color:white; size:24px">Story</span><span style="color:#E40914">wa</span>
                    </div>

                    <div class="wpb_text_column">
                        <p>
                            {{-- about section --}}
                        </p>
                    </div>

                    <form class="yikes-easy-mc-form layout-footer">
                        <label>
                            <input type="email" name="Email" placeholder="Email">
                        </label>

                        <button type="submit">SUBSCRIBE</button>
                    </form>

                    <div class="bp-element bp-element-social-links vblog-layout-footer">
                        <div class="wrap-element">
                            <a href="#" class="social-item">
                                <i class="ion ion-social-facebook"></i>
                            </a>

                            <a href="#" class="social-item">
                                <i class="ion ion-social-twitter"></i>
                            </a>
                            <a href="#" class="social-item">
                                <i class="ion ion-social-youtube"></i>
                            </a>

                            <a href="#" class="social-item">
                                <i class="ion ion-social-instagram-outline"></i>
                            </a>
                        </div>
                    </div>
                </aside>

                <aside class="widget widget_thim_layout_builder">
                    <!-- shortcode posts -->
                    <div class="bp-element bp-element-posts vblog-layout-list-footer">
                        <div class="wrap-element">
                            <div class="heading-post">
                                <h3 class="title">
                                    Latest Posts
                                </h3>
                            </div>

                            <div class="list-posts">
                                @foreach (posts() as $post)
                                    <div class="item">
                                        <div class="pic">
                                            <a href="{{ route('blog.show', $post->slug) }}">
                                                <img src="{{ asset('storage/' . $post->cover_photo_path) }}"
                                                    alt="IMG">
                                            </a>
                                        </div>

                                        <div class="text">
                                            <h4 class="title">
                                                <a href="{{ route('blog.show', $post->slug) }}">
                                                    {{ $post->title }}
                                                </a>
                                            </h4>

                                            <div class="date">
                                                {{ $post->formattedPublishedDate() }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- end shortcode posts -->
                </aside>

                <aside class="widget widget_thim_layout_builder">
                    <!-- shortcode categories -->
                    <div class="bp-element bp-element-categories layout-list-1">
                        <div class="wrap-element">
                            <h3 class="title">
                                POPULAR CATEGORY
                            </h3>

                            <ul class="list-categories">
                                @foreach (categories() as $category)
                                    <li class="cat-item">
                                        <a href="javascript:;">{{ $category->name }}</a>
                                        <span class="count">{{ $category->posts_count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- end shortcode categories -->
                </aside>
            </div>
        </div>
    </div>

    <div class="copyright-area">
        <div class="container">
            <div class="thim-1-col">
                <div class="copyright-text">
                    Copyright 2024 StoryWa by <a href="https://codprez.com">Codprez</a>
                </div>
            </div>
        </div>
    </div>
</footer>
