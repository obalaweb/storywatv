<x-guest-layout>
    <div id="main-content" style="background: #1e1e1e;">
        @if (isset($featuredVideo))
            <livewire:video-player :video="$featuredVideo" />
        @else
            <livewire:video-player />
        @endif
    </div>
</x-guest-layout>
