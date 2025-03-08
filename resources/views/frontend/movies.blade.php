<x-guest-layout layout="home-2">
    <div id="main-content">
        <div class="content-area">
            <!-- Page Header -->
            <div class="page-title">
                <div class="main-top" style="background-image: url({{ asset('assets/images/bg-page-title-01.jpg') }});">
                    <div class="overlay-top-header"></div>
                    <div class="content container">
                        <h1>Shop</h1>
                        <div class="wrap-breadcrumb">
                            <ul class="breadcrumbs">
                                <li>
                                    <a href="{{ route('index') }}">Home</a>
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

            <!-- Main Content -->
            <div class="site-content sidebar-right layout-1">
                <div class="container">
                    <div class="row">
                        <main class="site-main col-lg-9 col-md-8 col-sm-12">
                            <div class="wrap-main-content">
                                <div class="products-list">
                                    <div class="wrap-element">
                                        <!-- Sorting and Results -->
                                        <div class="heading-products">
                                            <div class="results">
                                                Showing {{ $movies->count() }} of {{ $movies->total() }} results
                                            </div>
                                            <div class="sorting-select">
                                                <label data-style="vblog-shop-page">
                                                    <select wire:model="sortBy" class="form-select">
                                                        <option value="default">Default sorting</option>
                                                        <option value="price_asc">Price: Low to High</option>
                                                        <option value="price_desc">Price: High to Low</option>
                                                        <option value="name">Sort by Name</option>
                                                        <option value="views">Sort by Popularity</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Products Grid -->
                                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                                            @forelse($movies as $movie)
                                                <div class="col">
                                                    <x-movie :movie="$movie" />
                                                </div>
                                            @empty
                                                <div class="col-12 text-center py-5">
                                                    <p class="text-muted">No movies found in the shop.</p>
                                                </div>
                                            @endforelse
                                        </div>

                                        <!-- Pagination -->
                                        @if ($movies->hasPages())
                                            <div class="pagination mt-4">
                                                {{ $movies->links() }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </main>

                        <!-- Sidebar -->
                        <aside class="widget-area col-lg-3 col-md-4 col-sm-12 sticky-sidebar">
                            <livewire:sidebar />
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
