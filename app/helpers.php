<?php

function site_name()
{

}

if (!function_exists('youtube_embed')) {
    function youtube_embed($url)
    {
        // Extract the video ID from the URL
        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);

        if (isset($matches[1])) {
            $videoId = $matches[1];
            return "<iframe width='560' height='315' src='https://www.youtube.com/embed/{$videoId}' frameborder='0' allowfullscreen></iframe>";
        }

        return "Invalid YouTube URL";
    }
}

if (!function_exists('convert_youtube_link')) {
    function convert_youtube_link($url)
    {
        // Check if the URL is already in standard format
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})/', $url)) {
            // Return the original URL if it's already in the standard format
            return $url;
        }

        // Check if the URL is a shortened YouTube link
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            // Extract the video ID from the match
            $videoId = $matches[1];
            // Return the standard watch URL
            return "https://www.youtube.com/watch?v={$videoId}";
        }

        // Return the original URL if it's not a shortened link
        return $url;
    }
}
