@props(['url', 'title'])

<div class="wrap-share-blog sticky-sidebar">
    <div class="share">
        <span class="namefield">Share</span>
        <span class="socials">
            <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" target="_blank" class="item-social">
                <i class="ion ion-social-facebook"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text={{ urlencode($title) }}"
                target="_blank" class="item-social">
                <i class="ion ion-social-twitter"></i>
            </a>
            <a href="https://plus.google.com/share?url={{ urlencode($url) }}" target="_blank" class="item-social">
                <i class="ion ion-social-googleplus"></i>
            </a>
        </span>
    </div>
</div>

<style>
    .wrap-share-blog {
        position: sticky;
        top: 20px;
        margin-right: 20px;
    }

    .share {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .namefield {
        font-weight: bold;
        color: #666;
    }

    .item-social {
        color: #666;
        font-size: 1.2rem;
        margin: 0 5px;
        transition: color 0.3s;
    }

    .item-social:hover {
        color: #007bff;
    }
</style>
