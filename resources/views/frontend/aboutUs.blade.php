<x-guest-layout>
    <div id="main-content">
        <div class="content-area">
            <!-- Page Header -->
            <div class="page-title">
                <div class="main-top" style="background-image: url({{ asset('assets/images/bg-page-title-03.jpg') }});">
                    <div class="overlay-top-header"></div>
                    <div class="content container">
                        <h1>About Us</h1>
                        <div class="wrap-breadcrumb">
                            <ul class="breadcrumbs">
                                <li><a href="{{ route('index') }}">Home</a></li>
                                <li><span class="breadcrum-icon">/</span> About Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="site-content layout-1">
                <main class="site-main">
                    <div class="wrap-main-content">
                        <!-- About Section -->
                        <section class="thim-about_about-page py-5">
                            <div class="container">
                                <x-heading title="Let’s Make Great Things Together!"
                                    subtitle="{{ $settings->site_tagline ?? 'Building amazing experiences.' }}"
                                    class="align-center" />

                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <p class="lead text-center">
                                            {{ $settings->about_us ?? 'We are a passionate team dedicated to creating exceptional content and experiences. Discover more about our journey and what drives us every day.' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Counter Stats -->
                                <x-counter-box :stats="$stats" />
                            </div>
                        </section>

                        <!-- Video Showcase -->
                        <section class="thim-video-showcase bg-light py-5">
                            <div class="container">
                                <x-video-slider :videos="$videos" />
                            </div>
                        </section>

                        <!-- Services Section -->
                        <section class="thim-services_about-page py-5">
                            <div class="container">
                                <x-heading title="Our Services"
                                    subtitle="Explore what we offer to bring your ideas to life."
                                    class="align-center" />
                                <div class="row g-4">
                                    @foreach ($services as $service)
                                        <div class="col-md-4">
                                            <x-icon-box :service="$service" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        <!-- Partners Section -->
                        <section class="thim-partner_about-page bg-light py-5">
                            <div class="container">
                                <x-brand-slider :partners="$partners" />
                            </div>
                        </section>

                        <!-- Team Section -->
                        <section class="thim-team_about-page py-5">
                            <div class="container">
                                <x-heading title="Creative Team" subtitle="Meet the people behind our success."
                                    class="align-center" />
                                <div class="row g-4">
                                    @foreach ($teamMembers as $member)
                                        <div class="col-md-4">
                                            <x-team-card :member="$member" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Scripts for Sliders -->
    @push('scripts')
        <script src="{{ asset('assets/js/slick.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.js-call-slick-col').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: false,
                    dots: true,
                    appendDots: '.wrap-dot-slick',
                    responsive: [{
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });

                $('.slide-brands').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    responsive: [{
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 4
                            }
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            });
        </script>
    @endpush
</x-guest-layout>
