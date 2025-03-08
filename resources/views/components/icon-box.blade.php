@props(['service'])

<div class="bp-element bp-element-icon-box align-center vblog-layout-1">
    <div class="icon-box">
        <div class="icon-image">
            <img src="{{ $service['icon'] }}" alt="{{ $service['title'] }}" />
        </div>
        <div class="content">
            <h3 class="title">{{ $service['title'] }}</h3>
            <div class="description">{{ $service['description'] }}</div>
        </div>
    </div>
</div>

<style>
    .bp-element-icon-box {
        padding: 20px;
    }

    .bp-element-icon-box .icon-image img {
        width: 80px;
        height: 80px;
        margin-bottom: 15px;
    }

    .bp-element-icon-box .title {
        font-size: 1.5rem;
        color: #2c3e50;
    }

    .bp-element-icon-box .description {
        color: #666;
    }
</style>
