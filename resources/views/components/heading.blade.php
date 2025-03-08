@props(['title', 'subtitle' => '', 'class' => ''])

<div class="bp-element bp-element-heading {{ $class }}">
    <h3 class="title">{{ $title }}</h3>
    @if ($subtitle)
        <div class="description">{{ $subtitle }}</div>
    @endif
</div>

<style>
    .bp-element-heading.align-center {
        text-align: center;
        margin-bottom: 2rem;
    }

    .bp-element-heading .title {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #2c3e50;
    }

    .bp-element-heading .description {
        font-size: 1.2rem;
        color: #666;
    }
</style>
