<x-guest-layout>
    <div id="main-content" style="background: #1e1e1e;">
        <!-- Banner home-1 -->
        @if (isset($featuredVideo))
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
        @endif
        <!-- end Banner home-1 -->
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
                        mute: 1,
                        modestbranding: 1
                    },
                    events: {
                        onReady: onPlayerReady,
                        onStateChange: onPlayerStateChange,
                        onError: onPlayerError // Added error handler
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

            // Handle video errors (e.g., video not found, invalid ID)
            function onPlayerError(event) {
                console.error("Player error occurred:", event.data);
                // Common error codes:
                // 2: Invalid parameter
                // 5: HTML5 player error
                // 100: Video not found
                // 101/150: Video not allowed to play
                clearInterval(checkInterval);
                playNextVideo(); // Play next video on error
            }

            function startTimeCheck() {
                clearInterval(checkInterval);
                checkInterval = setInterval(() => {
                    const currentTime = player.getCurrentTime();
                    const duration = player.getDuration();
                    const timeLeft = duration - currentTime;

                    if (timeLeft <= 2 && timeLeft > 0) {
                        clearInterval(checkInterval);
                        playNextVideo();
                    }
                }, 500);
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
                        console.error("No next video ID received, trying again...");
                        setTimeout(playNextVideo, 1000); // Retry after 1 second if no video ID
                    }
                } catch (error) {
                    console.error("Error fetching next video:", error);
                    // Retry after a delay in case of network or server errors
                    setTimeout(playNextVideo, 2000); // Retry after 2 seconds
                }
            }
        </script>
    @endsection

</x-guest-layout>
