<x-guest-layout layout="home-2">

    <div id="main-content">
        <div class="content-area">
            <div class="page-title">
                <div class="main-top" style="background-image: url(assets/images/bg-page-title-01.jpg);">
                    <div class="overlay-top-header"></div>

                    <div class="content container">
                        <h1>
                            Shop
                        </h1>

                        <div class="wrap-breadcrumb">
                            <ul class="breadcrumbs">
                                <li>
                                    <a href="javascript:;">
                                        Home
                                    </a>
                                </li>

                                <li>
                                    <span class="breadcrum-icon">/</span>

                                    Shop
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="site-content sidebar-right layout-1">
                <div class="container">
                    <div class="row">
                        <main class="site-main col-lg-9">
                            <div class="wrap-main-content">
                                <!-- Block products-list -->
                                <div class="products-list">
                                    <div class="wrap-element">
                                        <div class="heading-products">
                                            <div class="results">
                                                Showing all 8 results
                                            </div>

                                            <div class="sorting-select">
                                                <label data-style="vblog-shop-page">
                                                    <select>
                                                        <option>Default sorting</option>
                                                        <option>Sorting by prices</option>
                                                        <option>Sorting by name</option>
                                                        <option>Popular</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 col-md-4">
                                                @foreach($movies as $movie)
                                                    <x-movie :movie="$movie" />
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end Block products-list -->
                            </div>
                        </main>
                        <div class="widget-area col-sm-9 col-md-8 col-lg-3 sticky-sidebar">
                            <livewire:sidebar />
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-guest-layout>
