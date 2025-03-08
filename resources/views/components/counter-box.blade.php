@props(['stats'])

<div class="bp-element bp-element-counter-box align-center vblog-layout-1 show-line">
    @foreach ($stats as $stat)
        <div class="item">
            <span class="number" data-count="{{ $stat['value'] }}">0</span>
            <span class="text">{{ $stat['label'] }}</span>
        </div>
    @endforeach
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.bp-element-counter-box .number').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).data('count')
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now).toLocaleString());
                    }
                });
            });
        });
    </script>
@endpush

<style>
    .bp-element-counter-box {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .bp-element-counter-box .item {
        padding: 20px;
        text-align: center;
    }

    .bp-element-counter-box .number {
        display: block;
        font-size: 2.5rem;
        color: #007bff;
    }

    .bp-element-counter-box .text {
        font-size: 1.1rem;
        color: #666;
    }
</style>
