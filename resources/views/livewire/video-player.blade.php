<div>
    <div class="thim-banner_home-1" style="background-image: url(assets/images/gulu.jpg);">
        <div class="overlay-area"></div>

        <div class="container">
            <div class="bp-element bp-element-st-list-videos vblog-layout-1">
                <div class="wrap-element">
                    <div class="feature-item">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="video-container">
                                    <!-- Plyr Video Player -->
                                    <div class="plyr__video-embed" id="player">
                                        <iframe
                                            src="https://www.youtube.com/embed/{{ $currentVideo->youtube_id }}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
                                            allowfullscreen allowtransparency allow="autoplay" width="100%"
                                            height="580" frameborder="0">
                                        </iframe>
                                    </div>

                                    <!-- Loading Overlay -->
                                    <div id="loading-overlay" class="loading-overlay">
                                        <div class="loading-content">
                                            <div class="loading-title">Loading next video...</div>
                                            <div class="loading-spinner"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bp-element bp-element-st-list-videos vblog-layout-1-1">
                <div class="wrap-element">
                    <div class="normal-items">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text">
                                    <h1 class="title">
                                        <a href="#" style="color:white; font-size: 20px;">
                                            {{ $currentVideo->title }}
                                        </a>
                                    </h1>
                                    <div class="description">
                                        {{ $currentVideo->short_description }}
                                    </div>
                                    @if ($currentVideo->is_scheduled)
                                        <div class="schedule-info" style="color: #E40914; margin-top: 10px;">
                                            <i class="fa fa-clock-o"></i>
                                            Scheduled: {{ $currentVideo->scheduled_start_time->format('M d, Y H:i') }} -
                                            {{ $currentVideo->scheduled_end_time->format('M d, Y H:i') }}
                                        </div>
                                    @endif

                                    <a href="{{ route('videos.show', $currentVideo->youtube_id) }}"
                                        class="btn-readmore btn-normal shape-round">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .video-container {
            position: relative;
            width: 100%;
            height: 580px;
            overflow: hidden;
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            pointer-events: none;
        }

        .loading-overlay.visible {
            opacity: 1;
        }

        .loading-content {
            text-align: center;
            color: white;
            padding: 20px;
        }

        .loading-title {
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Plyr customizations */
        .plyr {
            --plyr-color-main: #E40914;
            --plyr-video-background: #000;
            color: #fff;
            height: 580px;
        }

        .plyr__video-embed {
            height: 100%;
        }

        .plyr__video-embed iframe {
            height: 100%;
        }
    </style>

    @push('scripts')
        <!-- Plyr CSS -->
        <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />

        <!-- Plyr JS -->
        <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>

        <script>
            (function() {
                // Configuration
                const config = {
                    debug: true,
                    playAttempts: [100, 500, 1000, 2000],
                    transitionDelay: 1000,
                    timeLeftThreshold: 3, // Increased threshold to ensure transition happens
                    scheduleCheckFrequency: 1000,
                    endedCheckInterval: 500 // New interval to check video ending
                };

                // State
                const state = {
                    player: null,
                    nextVideoData: null,
                    isLoading: false,
                    playerReady: false,
                    scheduleCheckInterval: null,
                    endedCheckInterval: null, // New interval to actively monitor video ending
                    lastKnownTime: 0,
                    stuckCounter: 0,
                    transitionRequested: false
                };

                // Player options
                const playerOptions = {
                    controls: [
                        'play-large', 'play', 'progress', 'current-time',
                        'mute', 'volume', 'captions', 'settings',
                        'pip', 'airplay', 'fullscreen'
                    ],
                    hideControls: true,
                    autoplay: true,
                    muted: true,
                    clickToPlay: true,
                    disableContextMenu: true,
                    keyboard: {
                        focused: true,
                        global: true
                    },
                    tooltips: {
                        controls: true,
                        seek: true
                    },
                    loadSprite: false
                };

                // Debug logging with timestamps
                function debug(message) {
                    if (config.debug) {
                        const timestamp = new Date().toISOString().substr(11, 8);
                        console.log(`[VideoPlayer ${timestamp}] ${message}`);
                    }
                }

                // Enhanced error logging
                function logError(context, error) {
                    if (error.message && (
                            error.message.includes('ERR_BLOCKED_BY_CLIENT') ||
                            error.message.includes('api/stats/qoe') ||
                            error.message.includes('ptracking')
                        )) {
                        debug(`Ignoring YouTube tracking error during ${context}`);
                        return false;
                    }

                    console.error(`[VideoPlayer] Error in ${context}:`, error);
                    return true;
                }

                // Schedule checking
                function checkScheduledVideo() {
                    try {
                        if (!state.nextVideoData?.scheduledStartTime) {
                            return;
                        }

                        const now = new Date();
                        const scheduledStart = new Date(state.nextVideoData.scheduledStartTime);

                        if (now >= scheduledStart && !state.isLoading) {
                            debug("Scheduled video start time reached");
                            transitionToNextVideo();
                        }
                    } catch (error) {
                        logError('schedule checking', error);
                    }
                }

                function startScheduleCheck() {
                    debug("Starting schedule check");
                    stopScheduleCheck();
                    state.scheduleCheckInterval = setInterval(checkScheduledVideo, config.scheduleCheckFrequency);
                }

                function stopScheduleCheck() {
                    if (state.scheduleCheckInterval) {
                        debug("Stopping schedule check");
                        clearInterval(state.scheduleCheckInterval);
                        state.scheduleCheckInterval = null;
                    }
                }

                // DOM manipulation helpers
                function showLoadingOverlay() {
                    const overlay = document.getElementById('loading-overlay');
                    if (overlay) {
                        overlay.classList.add('visible');
                    }
                }

                function hideLoadingOverlay() {
                    const overlay = document.getElementById('loading-overlay');
                    if (overlay) {
                        overlay.classList.remove('visible');
                    }
                }

                function toggleElementsState(selector, enable) {
                    document.querySelectorAll(selector).forEach(element => {
                        if (enable) {
                            element.classList.remove('disabled');
                            element.style.opacity = '1';
                            element.style.pointerEvents = 'auto';
                        } else {
                            element.classList.add('disabled');
                            element.style.opacity = '0.5';
                            element.style.pointerEvents = 'none';
                        }
                    });
                }

                function enableVideoCards() {
                    toggleElementsState('.video-card', true);
                    toggleElementsState('.watch-later-btn, .forward-btn', true);
                }

                function disableVideoCards() {
                    toggleElementsState('.video-card', false);
                    toggleElementsState('.watch-later-btn, .forward-btn', false);
                }

                function updateVideoInfo(data) {
                    try {
                        if (!data) return;

                        const titleElement = document.querySelector('.title a');
                        const descriptionElement = document.querySelector('.description');
                        const readMoreButton = document.querySelector('.btn-readmore');

                        if (titleElement) titleElement.textContent = data.title;
                        if (descriptionElement) descriptionElement.textContent = data.description;
                        if (readMoreButton) readMoreButton.href = `/videos/${data.youtubeId}`;

                        debug("UI updated with new video information");
                    } catch (error) {
                        logError('updating video info', error);
                    }
                }

                // Active video monitoring
                function startVideoEndMonitoring() {
                    debug("Starting active video end monitoring");

                    if (state.endedCheckInterval) {
                        clearInterval(state.endedCheckInterval);
                    }

                    state.stuckCounter = 0;
                    state.lastKnownTime = 0;
                    state.transitionRequested = false;

                    state.endedCheckInterval = setInterval(() => {
                        try {
                            if (!state.playerReady || state.isLoading) {
                                return;
                            }

                            // Method 1: Check through Plyr API
                            if (state.player) {
                                const currentTime = state.player.currentTime;
                                const duration = state.player.duration;

                                // Check if playback is stuck (same time for multiple checks)
                                if (currentTime === state.lastKnownTime && currentTime > 0) {
                                    state.stuckCounter++;
                                    if (state.stuckCounter > 6) { // 3 seconds (6 * 500ms)
                                        debug("Video appears to be stuck - forcing transition");
                                        transitionToNextVideo();
                                        return;
                                    }
                                } else {
                                    state.stuckCounter = 0;
                                    state.lastKnownTime = currentTime;
                                }

                                // Valid time values check
                                if (isFinite(currentTime) && isFinite(duration) && duration > 0) {
                                    const timeLeft = duration - currentTime;
                                    const percentComplete = (currentTime / duration) * 100;

                                    // Multiple transition triggers for different scenarios
                                    if (timeLeft <= config.timeLeftThreshold && timeLeft > 0) {
                                        debug(
                                            `Video ending soon (${timeLeft.toFixed(1)}s left) - Preparing transition`
                                        );
                                        if (!state.transitionRequested) {
                                            state.transitionRequested = true;
                                            transitionToNextVideo();
                                        }
                                        return;
                                    }

                                    // Also check if video is nearly complete (over 95%)
                                    if (percentComplete > 95 && currentTime > 0) {
                                        debug(
                                            `Video at ${percentComplete.toFixed(1)}% complete - Preparing transition`
                                        );
                                        if (!state.transitionRequested) {
                                            state.transitionRequested = true;
                                            transitionToNextVideo();
                                        }
                                        return;
                                    }
                                }
                            }

                            // Method 2: Direct DOM access as fallback
                            try {
                                const iframe = document.querySelector('#player iframe');
                                if (iframe) {
                                    // This might throw CORS errors which we just catch silently
                                    const videoElement = iframe.contentDocument?.querySelector('video');
                                    if (videoElement) {
                                        const currTime = videoElement.currentTime;
                                        const dur = videoElement.duration;

                                        if (isFinite(currTime) && isFinite(dur) && dur > 0) {
                                            const timeLeft = dur - currTime;
                                            if (timeLeft <= config.timeLeftThreshold && timeLeft > 0) {
                                                debug(
                                                    `Direct DOM: Video ending soon (${timeLeft.toFixed(1)}s left)`
                                                );
                                                if (!state.transitionRequested) {
                                                    state.transitionRequested = true;
                                                    transitionToNextVideo();
                                                }
                                            }
                                        }
                                    }
                                }
                            } catch (e) {
                                // CORS errors expected, ignore silently
                            }
                        } catch (error) {
                            logError('video end monitoring', error);
                        }
                    }, config.endedCheckInterval);
                }

                function stopVideoEndMonitoring() {
                    if (state.endedCheckInterval) {
                        clearInterval(state.endedCheckInterval);
                        state.endedCheckInterval = null;
                    }
                }

                // Player event handlers
                function onPlayerReady() {
                    debug("Player ready - Starting playback");
                    state.playerReady = true;

                    // Make sure player is muted to increase chances of autoplay working
                    if (state.player && typeof state.player.muted === 'boolean') {
                        state.player.muted = true;
                    }

                    // Initial play attempt
                    safePlayAttempt();

                    // Multiple delayed play attempts for autoplay issues
                    config.playAttempts.forEach(delay => {
                        setTimeout(() => safePlayAttempt(), delay);
                    });

                    enableVideoCards();
                    startVideoEndMonitoring();
                }

                function safePlayAttempt() {
                    try {
                        if (!state.player) {
                            debug("Player not initialized yet, cannot attempt play");
                            return;
                        }

                        if (!state.player.playing) {
                            debug("Attempting to play");

                            // Check if play method exists and is a function
                            if (typeof state.player.play === 'function') {
                                const playPromise = state.player.play();

                                // Only call catch if we have a promise
                                if (playPromise !== undefined && playPromise !== null && typeof playPromise.catch ===
                                    'function') {
                                    playPromise.catch(error => {
                                        if (error.name === 'NotAllowedError') {
                                            debug("Autoplay prevented by browser policy");
                                            // Attempt to mute and play again as fallback
                                            if (state.player && typeof state.player.muted === 'function') {
                                                state.player.muted = true;
                                                setTimeout(() => {
                                                    if (state.player && typeof state.player.play ===
                                                        'function') {
                                                        state.player.play().catch(e => debug(
                                                            "Second play attempt failed: " + e
                                                            .message));
                                                    }
                                                }, 1000);
                                            }
                                        } else {
                                            logError('play attempt', error);
                                        }
                                    });
                                } else {
                                    debug("Play didn't return a promise, or returned null");
                                }
                            } else {
                                debug("Player doesn't have a play method");
                            }
                        }
                    } catch (error) {
                        logError('play attempt', error);
                    }
                }

                function onTimeUpdate() {
                    try {
                        if (!state.playerReady || state.isLoading) {
                            return;
                        }

                        const currentTime = state.player.currentTime;
                        const duration = state.player.duration;

                        // Update last known time for stuck detection
                        state.lastKnownTime = currentTime;

                        // Check for valid time values
                        if (!isFinite(currentTime) || !isFinite(duration) || duration <= 0) {
                            return;
                        }

                        const timeLeft = duration - currentTime;
                        const percentComplete = (currentTime / duration) * 100;

                        // Multiple transition triggers
                        if ((timeLeft <= config.timeLeftThreshold && timeLeft > 0) ||
                            (percentComplete > 95 && currentTime > 10)) {

                            if (!state.transitionRequested) {
                                debug(
                                    `Video ending soon (${timeLeft.toFixed(1)}s left / ${percentComplete.toFixed(1)}%) - Initiating transition`
                                );
                                state.transitionRequested = true;
                                transitionToNextVideo();
                            }
                        }
                    } catch (error) {
                        logError('time update', error);
                    }
                }

                function onVideoEnded() {
                    debug("Video ended event received - Loading next video");
                    if (!state.transitionRequested) {
                        state.transitionRequested = true;
                        transitionToNextVideo();
                    }
                }

                function onPlayerError(error) {
                    const isTracking = logError('player error handler', error);
                    if (!isTracking && !state.isLoading && !state.transitionRequested) {
                        debug("Error detected - Attempting to load next video");
                        state.transitionRequested = true;
                        transitionToNextVideo();
                    }
                }

                function onPlayerStateChange(event) {
                    try {
                        debug(`Player state changed: ${event.type}`);
                        if (event.type === 'play') {
                            enableVideoCards();
                        } else if (event.type === 'pause') {
                            disableVideoCards();

                            // Check if video is at the end and paused (YouTube behavior)
                            if (state.player) {
                                const currentTime = state.player.currentTime;
                                const duration = state.player.duration;

                                if (isFinite(currentTime) && isFinite(duration) &&
                                    duration > 0 && (duration - currentTime) < 0.5) {
                                    debug("Video paused at end - Initiating transition");
                                    if (!state.transitionRequested) {
                                        state.transitionRequested = true;
                                        transitionToNextVideo();
                                    }
                                }
                            }
                        }
                    } catch (error) {
                        logError('player state change', error);
                    }
                }

                // Main transition function
                function transitionToNextVideo() {
                    if (state.isLoading) {
                        debug("Transition already in progress - ignoring request");
                        return;
                    }

                    if (!state.playerReady) {
                        debug("Player not ready yet - queueing transition");
                        setTimeout(transitionToNextVideo, 1000);
                        return;
                    }

                    state.isLoading = true;
                    state.transitionRequested = true;
                    debug("Starting video transition");

                    // Stop monitoring during transition
                    stopVideoEndMonitoring();

                    showLoadingOverlay();
                    disableVideoCards();

                    try {
                        // Determine what video to load
                        let youtubeId, title, description;

                        if (state.nextVideoData && state.nextVideoData.youtubeId) {
                            debug(`Loading next video: ${state.nextVideoData.title}`);
                            youtubeId = state.nextVideoData.youtubeId;
                            title = state.nextVideoData.title;
                            description = state.nextVideoData.description;
                        } else {
                            debug("No next video available, repeating current video");
                            // Extract current video information
                            const currentSrc = state.player?.source || '';
                            youtubeId = extractYoutubeId(currentSrc);

                            // If we can't get a YouTube ID from the current player, get it from the iframe directly
                            if (!youtubeId) {
                                const iframe = document.querySelector('#player iframe');
                                if (iframe && iframe.src) {
                                    youtubeId = extractYoutubeId(iframe.src);
                                }
                            }

                            // If still no YouTube ID, use a fallback
                            if (!youtubeId) {
                                debug("Using fallback video as no valid YouTube ID found");
                                // Default fallback YouTube ID - replace with your own
                                youtubeId = document.querySelector('.plyr__video-embed iframe')?.src?.split('embed/')[1]
                                    ?.split('?')[0] || 'dQw4w9WgXcQ';
                            }

                            const titleElement = document.querySelector('.title a');
                            const descriptionElement = document.querySelector('.description');

                            title = titleElement ? titleElement.textContent : 'Video';
                            description = descriptionElement ? descriptionElement.textContent : '';
                        }

                        // Log the YouTube ID to help with debugging
                        debug(`Using YouTube ID: ${youtubeId}`);

                        // First destroy the existing player completely
                        if (state.player) {
                            debug("Destroying current player");
                            try {
                                state.player.destroy();
                            } catch (e) {
                                debug("Player destruction error (non-critical)");
                            }
                            state.player = null;
                        }

                        // Create new iframe with proper attributes
                        const newIframe = document.createElement('iframe');
                        newIframe.src =
                            `https://www.youtube.com/embed/${youtubeId}?origin=https://plyr.io&iv_load_policy=3&modestbranding=1&playsinline=1&showinfo=0&rel=0&enablejsapi=1&autoplay=1&mute=1`;
                        newIframe.allowFullscreen = true;
                        newIframe.allowTransparency = true;
                        newIframe.allow = "autoplay; fullscreen";
                        newIframe.width = "100%";
                        newIframe.height = "580";
                        newIframe.frameBorder = "0";
                        newIframe.loading = "eager"; // Prioritize loading
                        newIframe.id = "youtube-iframe"; // Add ID for easier reference

                        // Replace with new iframe
                        const playerContainer = document.querySelector('#player');
                        if (!playerContainer) {
                            throw new Error("Player container not found");
                        }

                        debug("Replacing iframe and reinitializing player");
                        playerContainer.innerHTML = '';
                        playerContainer.appendChild(newIframe);

                        // Initialize new player
                        state.playerReady = false;
                        state.player = new Plyr('#player', playerOptions);

                        // Set up event listeners
                        state.player.on('ready', onPlayerReady);
                        state.player.on('timeupdate', onTimeUpdate);
                        state.player.on('ended', onVideoEnded);
                        state.player.on('error', onPlayerError);
                        state.player.on('play', onPlayerStateChange);
                        state.player.on('pause', onPlayerStateChange);

                        // Update UI with video information
                        updateVideoInfo({
                            title,
                            description,
                            youtubeId
                        });

                        debug("Video transition in progress");
                    } catch (error) {
                        const isCritical = logError('loading video', error);
                        if (isCritical) {
                            debug("Critical error during video load - Attempting recovery");
                            setTimeout(() => {
                                try {
                                    // Final fallback - direct iframe replacement
                                    const playerContainer = document.querySelector('#player');
                                    if (playerContainer) {
                                        playerContainer.innerHTML = `
                        <iframe 
                            src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1" 
                            width="100%" 
                            height="580" 
                            frameborder="0" 
                            allow="autoplay; fullscreen" 
                            allowfullscreen>
                        </iframe>`;
                                    }
                                } catch (recoveryError) {
                                    logError('recovery attempt', recoveryError);
                                }

                                hideLoadingOverlay();
                                state.isLoading = false;
                                state.transitionRequested = false;
                                enableVideoCards();
                            }, 2000);
                            return;
                        }
                    }

                    // Complete transition after delay
                    setTimeout(() => {
                        hideLoadingOverlay();
                        state.isLoading = false;
                        state.transitionRequested = false;

                        // Ensure player is playing
                        safePlayAttempt();

                        // Notify Livewire component
                        try {
                            if (window.Livewire) {
                                debug("Notifying Livewire of transition completion");
                                const wireId = document.querySelector('[wire\\:id]')?.getAttribute('wire:id');
                                if (wireId) {
                                    const component = window.Livewire.find(wireId);
                                    if (component && typeof component.transitionToNextVideo === 'function') {
                                        component.transitionToNextVideo();
                                    }
                                }
                            }
                        } catch (error) {
                            logError('Livewire notification', error);
                        }
                    }, config.transitionDelay);
                }


                // Helper to extract YouTube ID from various formats
                function extractYoutubeId(url) {
                    if (!url) return null;

                    // For iframe src format
                    if (url.includes('/embed/')) {
                        const parts = url.split('/embed/')[1];
                        if (parts) {
                            return parts.split('?')[0].split('/')[0];
                        }
                    }

                    // For standard YouTube URL
                    const regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
                    const match = url.match(regExp);
                    return (match && match[7] && match[7].length === 11) ? match[7] : null;
                }
                // Set up custom control behavior
                function setupCustomControls() {
                    try {
                        const watchLaterBtn = document.querySelector('.watch-later-btn');
                        if (watchLaterBtn) {
                            watchLaterBtn.addEventListener('click', function(e) {
                                if (this.classList.contains('disabled')) {
                                    e.preventDefault();
                                    return;
                                }
                                debug("Watch Later clicked");
                                // Add watch later functionality here
                            });
                        }

                        const forwardBtn = document.querySelector('.forward-btn');
                        if (forwardBtn) {
                            forwardBtn.addEventListener('click', function(e) {
                                if (this.classList.contains('disabled')) {
                                    e.preventDefault();
                                    return;
                                }
                                debug("Forward clicked - Manually triggering transition");
                                transitionToNextVideo();
                            });
                        }

                        // Add skip button if not present
                        if (!document.querySelector('.skip-btn')) {
                            const playerContainer = document.querySelector('.plyr__controls');
                            if (playerContainer) {
                                const skipBtn = document.createElement('button');
                                skipBtn.className = 'skip-btn plyr__control';
                                skipBtn.innerHTML = '<span>Next</span>';
                                skipBtn.title = 'Skip to next video';
                                skipBtn.addEventListener('click', function() {
                                    debug("Skip button clicked");
                                    transitionToNextVideo();
                                });
                                playerContainer.appendChild(skipBtn);
                            }
                        }

                        debug("Custom controls initialized");
                    } catch (error) {
                        logError('setting up custom controls', error);
                    }
                }

                // Initialize Livewire events
                function setupLivewireEvents() {
                    try {
                        if (!window.Livewire) {
                            debug("Livewire not available yet");
                            setTimeout(setupLivewireEvents, 500);
                            return;
                        }

                        debug("Setting up Livewire event listeners");
                        window.Livewire.on('nextVideoPrepared', (data) => {
                            try {
                                debug(`Next video prepared: ${data.title}, YouTube ID: ${data.youtubeId}`);

                                // Make sure we have a valid YouTube ID before storing
                                if (!data.youtubeId) {
                                    debug("WARNING: Received next video data without YouTube ID");
                                }

                                state.nextVideoData = data;

                                if (data.scheduledStartTime) {
                                    debug(`Next video scheduled for: ${data.scheduledStartTime}`);
                                    startScheduleCheck();
                                }
                            } catch (error) {
                                logError('processing next video data', error);
                            }
                        });

                        // Add new event listener for force transition
                        window.Livewire.on('forceVideoTransition', () => {
                            try {
                                debug("Force transition received from Livewire");
                                transitionToNextVideo();
                            } catch (error) {
                                logError('force transition', error);
                            }
                        });
                    } catch (error) {
                        logError('setting up Livewire events', error);
                    }
                }
                // Setup keyboard shortcuts
                function setupKeyboardShortcuts() {
                    try {
                        document.addEventListener('keydown', (e) => {
                            // Add keyboard shortcut - "N" key to go to next video
                            if (e.key === 'n' || e.key === 'N') {
                                debug("Next video keyboard shortcut pressed");
                                transitionToNextVideo();
                            }
                        });
                    } catch (error) {
                        logError('keyboard shortcuts setup', error);
                    }
                }

                // Full initialization
                function initialize() {
                    debug("Initializing video player system");

                    try {
                        // Initialize player
                        state.player = new Plyr('#player', playerOptions);

                        // Set up event listeners
                        state.player.on('ready', onPlayerReady);
                        state.player.on('timeupdate', onTimeUpdate);
                        state.player.on('ended', onVideoEnded);
                        state.player.on('error', onPlayerError);
                        state.player.on('play', onPlayerStateChange);
                        state.player.on('pause', onPlayerStateChange);

                        // Set up other components
                        setupCustomControls();
                        setupLivewireEvents();
                        setupKeyboardShortcuts();
                        startScheduleCheck();
                        startVideoEndMonitoring();

                        debug("Player initialization complete");

                        // Add manual transition buttons for better UX
                        const nextBtn = document.createElement('button');
                        nextBtn.className = 'btn btn-primary mt-2 mb-2';
                        nextBtn.innerText = 'Next Video';
                        nextBtn.addEventListener('click', transitionToNextVideo);

                        const playerParent = document.querySelector('#player').parentElement;
                        if (playerParent && !document.querySelector('.manual-next-btn')) {
                            nextBtn.classList.add('manual-next-btn');
                            playerParent.appendChild(nextBtn);
                        }
                    } catch (error) {
                        logError('initialization', error);
                        // Try to recover with a delayed retry
                        setTimeout(() => {
                            debug("Attempting to recover from initialization failure");
                            try {
                                state.player = new Plyr('#player', playerOptions);
                            } catch (retryError) {
                                logError('recovery attempt', retryError);
                            }
                        }, 2000);
                    }
                }

                // Set up initialization triggers
                document.addEventListener('DOMContentLoaded', initialize);

                // Set up Livewire initialization
                document.addEventListener('livewire:initialized', setupLivewireEvents);

                // Also check if Livewire is already available
                if (window.Livewire) {
                    setupLivewireEvents();
                }

                // Make transition function available globally for debugging
                window.forceNextVideo = transitionToNextVideo;
            })(); // End of IIFE
        </script>
    @endpush
</div>
