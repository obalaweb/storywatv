@props(['movie'])
<div class="item-product">
    <div class="media-item">
        <div class="pic">
            <a href="{{route('showMovie', $movie->slug)}}">
                <img src="{{$movie->thumbnail->url}}" alt="">
        </div>
        <a href="javascript:;" class="btn-addcart">
            <i class="ion ion-android-cart"></i>
            Add to cart
        </a>
    </div>

    <div class="text-item">
        <h4 class="title">
            <a href="{{route('showMovie', $movie->slug)}}" class="">
                {{ $movie->title }}
            </a>
        </h4>

        <span class="price">
            <del>
                <span class="woocommerce-Price-amount">
                    <span class="woocommerce-Price-currencySymbol">£</span>9.00
                </span>
            </del>

            <ins>
                <span class="woocommerce-Price-amount">
                    <span class="woocommerce-Price-currencySymbol">£</span>{{ $movie->price }}
                </span>
            </ins>
        </span>
    </div>
</div>
