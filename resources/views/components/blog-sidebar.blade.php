@props(['categories', 'popularPosts'])

<aside class="widget widget_search">
    <form class="search-form" method="GET" action="{{ route('blog.index') }}">
        <label>
            <span class="screen-reader-text">Search for:</span>
            <input class="search-field" type="text" name="search" placeholder="Search posts..."
                value="{{ request('search') }}">
        </label>
        <input class="search-submit" type="submit" value="Search">
    </form>
</aside>

<aside class="widget widget_categories">
    <h3 class="widget-title">Categories</h3>
    <ul>
        @foreach ($categories as $category)
            <li class="cat-item">
                <a href="{{ route('blog.category', $category->slug) }}">{{ $category->name }}</a>
                <span class="count">{{ $category->posts->count() }}</span>
            </li>
        @endforeach
    </ul>
</aside>

<aside class="widget widget_thim_layout_builder">
    <div class="bp-element bp-element-posts layout-list-2">
        <div class="wrap-element">
            <div class="heading-post">
                <h3 class="title">Most Popular</h3>
            </div>
            <div class="list-posts">
                @foreach ($popularPosts as $popular)
                    <div class="post-item">
                        <a href="{{ route('blog.show', $popular->slug) }}" class="pic">
                            <img src="{{ $popular->feature_photo ?? asset('assets/images/post-53.jpg') }}"
                                alt="{{ $popular->title }}">
                        </a>
                        <div class="text">
                            <h4 class="title">
                                <a href="{{ route('blog.show', $popular->slug) }}">{{ $popular->title }}</a>
                            </h4>
                            <div class="info">{{ $popular->formattedPublishedDate() }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</aside>

<style>
    .widget {
        margin-bottom: 30px;
    }

    .widget-title {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .search-form {
        display: flex;
        gap: 10px;
    }

    .search-field {
        flex: 1;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .search-submit {
        padding: 8px 15px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
    }

    .widget_categories ul {
        list-style: none;
        padding: 0;
    }

    .cat-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .cat-item a {
        color: #2c3e50;
        text-decoration: none;
    }

    .cat-item a:hover {
        color: #007bff;
    }

    .count {
        color: #666;
    }

    .bp-element-posts .post-item {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .bp-element-posts .pic img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
    }

    .bp-element-posts .title a {
        font-size: 1rem;
        color: #2c3e50;
        text-decoration: none;
    }

    .bp-element-posts .title a:hover {
        color: #007bff;
    }

    .bp-element-posts .info {
        color: #666;
        font-size: 0.9rem;
    }
</style>
