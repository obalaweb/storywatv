<div class="item-slick">
    <div class="post-item">

        <img src="{{ isset($category->thumbnail) ? $category->image->url : '' }}" alt="IMG">

        <div class="overlay"></div>

        <a href="#" class="content">
            <span class="title">{{ $category->name }}</span> {{ $category->videos_count }} Videos
        </a>
    </div>
</div>
