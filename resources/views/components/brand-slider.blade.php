@props(['partners'])

<div class="bp-element bp-element-brands vblog-layout-slider-1">
    <div class="wrap-element">
        <div class="slide-brands">
            @foreach ($partners as $partner)
                <div class="item-slick">
                    <div class="brand-item">
                        <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="img-fluid">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .bp-element-brands .brand-item img {
        max-height: 80px;
        width: auto;
        opacity: 0.7;
        transition: opacity 0.3s;
    }

    .bp-element-brands .brand-item img:hover {
        opacity: 1;
    }
</style>
