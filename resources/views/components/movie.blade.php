@props(['movie'])

<div class="item-product-scoped">
    <div class="media-item-scoped">
        <div class="pic-scoped">
            <a href="{{ route('showMovie', $movie->slug) }}">
                <img src="{{ $movie->thumbnail->url ?? asset('assets/images/default-movie.jpg') }}"
                    alt="{{ $movie->title }}" class="img-fluid">
            </a>
        </div>
        @if ($movie->is_available)
            <a href="javascript:;" class="btn-addcart" wire:click="addToCart('{{ $movie->id }}')"
                @if (!$movie->price) disabled @endif>
                <i class="ion ion-android-cart"></i>
                Add to Cart
            </a>
        @else
            <span class="btn-addcart disabled">
                <i class="ion ion-android-close"></i>
                Unavailable
            </span>
        @endif
    </div>

    <div class="text-item">
        <h4 class="title">
            <a href="{{ route('showMovie', $movie->slug) }}">{{ $movie->title }}</a>
        </h4>
        <div class="movie-meta">
            <span class="genre">{{ ucwords($movie->genre) }}</span>
            @if ($movie->rating)
                <span class="rating">
                    <i class="ion ion-star"></i> {{ number_format($movie->rating, 1) }}/10
                </span>
            @endif
        </div>
        <span class="price">
            @if ($movie->price > 0)
                <del>
                    <span class="woocommerce-Price-amount">
                        <span class="woocommerce-Price-currencySymbol">UGX</span>
                        {{ number_format($movie->price * 1.2, 0) }} <!-- 20% "original" price -->
                    </span>
                </del>
                <ins>
                    <span class="woocommerce-Price-amount">
                        <span class="woocommerce-Price-currencySymbol">UGX</span>
                        {{ number_format($movie->price, 0) }}
                    </span>
                </ins>
            @else
                <span class="woocommerce-Price-amount free">
                    Free
                </span>
            @endif
        </span>
    </div>
</div>

<style>
    .item-product-scoped {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .item-product-scoped:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .media-item-scoped {
        position: relative;
        overflow: hidden;
    }

    .pic-scoped img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .item-product-scoped:hover .pic-scoped img {
        transform: scale(1.05);
    }

    .btn-addcart {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: red;
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .item-product-scoped:hover .btn-addcart {
        opacity: 1;
    }

    .btn-addcart:hover {
        color: black !important;
    }

    .btn-addcart.disabled {
        background: #6c757d;
        cursor: not-allowed;
        opacity: 1;
    }

    .text-item {
        padding: 15px;
    }

    .title {
        font-size: 1.2rem;
        margin: 0 0 10px;
    }

    .title a {
        color: #2c3e50;
        text-decoration: none;
    }

    .title a:hover {
        color: red;
    }

    .movie-meta {
        margin-bottom: 10px;
        font-size: 0.9rem;
        color: #666;
    }

    .movie-meta .genre {
        margin-right: 10px;
    }

    .movie-meta .rating {
        color: #f39c12;
    }

    .price {
        display: block;
        font-size: 1.1rem;
    }

    .price del {
        color: #999;
        margin-right: 10px;
    }

    .price ins {
        color: #e74c3c;
        text-decoration: none;
        font-weight: bold;
    }

    .price .free {
        color: #27ae60;
        font-weight: bold;
    }
</style>
