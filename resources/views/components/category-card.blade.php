<div class="item-slick">
    <div class="post-item">
        <img src="{{ $category->thumbnail ? $category->url : '' }}" alt="IMG">

        <div class="overlay"></div>

        <a href="#" class="content">
            <span class="title">{{ $category->name }}</span> {{ $category->videos_count }} Videos
        </a>
    </div>
</div>
