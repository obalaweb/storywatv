@props(['title', 'image' => asset('assets/images/bg-page-title-01.jpg')])
<div class="page-title">
    <div class="main-top" style="background-image: url({{ $image }});">
        <div class="overlay-top-header"></div>

        <div class="content container">
            <h1>
                {{ $title }}
            </h1>

            <div class="wrap-breadcrumb">
                <ul class="breadcrumbs">
                    <li>
                        <a href="{{ route('index') }}">
                            Home
                        </a>
                    </li>

                    <li>
                        <span class="breadcrum-icon">/</span>
                        {{ $title }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
