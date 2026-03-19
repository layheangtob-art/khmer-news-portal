<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>KH News - ព័ត៌មានខ្មែរ</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Koulen&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_for_header_2.png') }}">

    <!-- <link rel="" type="image/png" href="{{ asset('img/logo.png') }}"> -->


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@100;600;800&display=swap"
        rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&family=Koulen&display=swap"
        rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('th/lib/animate/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('th/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('th/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('th/css/style.css') }}" rel="stylesheet" />

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/scroll.css') }}">
    <link rel="stylesheet" href="{{ asset('css/news-grid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/back-to-top.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category-view.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sponsor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modern-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ckeditor-content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnews-style.css') }}">
    <script src="https://unpkg.com/@hotwired/turbo@8.0.0/dist/turbo.es2017-umd.js"></script>
    <script>
        document.addEventListener('turbo:load', function() {
            if (typeof jQuery !== 'undefined') {
                jQuery(document).trigger('ready');
            }
        });
    </script>
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .nav-link,
        .dropdown-item,
        .card-title,
        .section-title,
        .breaking-title,
        .ticker-item,
        .magnews-article-title,
        .magnews-meta-info,
        .magnews-article-content,
        .magnews-sidebar-title,
        .magnews-sidebar-link,
        .magnews-footer-text,
        .magnews-footer-title,
        .magnews-footer-post-title,
        .magnews-footer-category-link {
            font-family: 'Kantumruy Pro', sans-serif !important;
        }
    </style>
</head>

<body>
    <!-- Top Dark Bar -->
    <div class="magnews-topbar d-none d-md-block">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-2">
                <div class="magnews-topbar-left">
                    <span class="magnews-date">{{ now()->translatedFormat('l F d, Y') }}</span>
                </div>
                <div class="magnews-topbar-right d-flex align-items-center gap-3">
                    <!-- <a href="#" class="magnews-topbar-link">Login</a>
                    <a href="#" class="magnews-topbar-link">Register</a> -->
                    <div class="magnews-social-icons d-flex align-items-center gap-2">
                        <a href="#" class="magnews-social-icon" title="Facebook"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" class="magnews-social-icon" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="magnews-social-icon" title="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="magnews-social-icon" title="Vimeo"><i class="fab fa-vimeo-v"></i></a>
                    </div>
                    {{-- <button class="magnews-search-icon-btn" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search"></i>
                    </button> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Header Section with Logo and Ad -->
    <div class="magnews-header d-none d-md-block">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col-md-4">
                    <a href="{{ route('index') }}" class="magnews-logo">
                        <img src="{{ asset('img/logo.png') }}" alt="KH News Logo" style="max-height: 100px;">
                    </a>
                </div>
                <div class="col-md-8 d-none d-md-block">
                    <div class="magnews-ad-banner">
                        @php
                        $headerBanner = $homeBanners ?? $categoryBanners ?? $detailBanners ?? null;
                        @endphp
                        @if (isset($headerBanner) && $headerBanner->count() > 0)
                        @foreach ($headerBanner->take(1) as $banner)
                        @if ($banner->url)
                        <a href="{{ $banner->url }}" target="_blank" rel="noopener">
                            <img src="{{ asset('storage/banners/' . $banner->image) }}"
                                alt="{{ $banner->title }}" class="img-fluid w-100"
                                style="max-height: 100px; object-fit: cover;"
                                onerror="this.style.display='none';">
                        </a>
                        @else
                        <img src="{{ asset('storage/banners/' . $banner->image) }}"
                            alt="{{ $banner->title }}" class="img-fluid w-100"
                            style="max-height: 100px; object-fit: cover;"
                            onerror="this.style.display='none';">
                        @endif
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Header Bar (Responsive) -->
    <div class="magnews-mobile-header d-md-none">
        <div class="container">
            <div class="magnews-mobile-header-content">
                <a href="{{ route('index') }}" class="magnews-mobile-logo">
                    <img src="{{ asset('img/logo.png') }}" alt="KH News Logo" style="max-height: 50px;">
                </a>
                <div class="d-flex align-items-center gap-2">
                    <button class="magnews-theme-toggle-btn" type="button" id="themeToggleButtonMobile"
                        style="margin-left: 0;">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button class="magnews-mobile-menu-toggle" type="button" id="mobileMenuToggle"
                        aria-label="Toggle menu">
                        <span class="magnews-hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Ad Banner (Responsive) -->
    @php
    $mobileHeaderBanner = $homeBanners ?? $categoryBanners ?? $detailBanners ?? null;
    @endphp
    @if (isset($mobileHeaderBanner) && $mobileHeaderBanner->count() > 0)
    <div class="magnews-mobile-ad-banner d-md-none">
        <div class="container">
            <div class="magnews-mobile-ad-inner">
                @foreach ($mobileHeaderBanner->take(1) as $banner)
                <a href="{{ $banner->url ?? '#' }}" class="magnews-mobile-ad-link" @if($banner->url) target="_blank" rel="noopener" @endif>
                    <img src="{{ asset('storage/banners/' . $banner->image) }}"
                        alt="{{ $banner->title }}" class="magnews-mobile-ad-img"
                        onerror="this.style.display='none';">
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Main Navigation Bar -->
    <div class="magnews-navbar sticky-top d-none d-md-block">
        <div class="container">
            <nav class="navbar navbar-expand-md px-0">

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav magnews-nav-menu">
                        <li class="nav-item">
                            <a href="{{ route('index') }}"
                                class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}">ទំព័រដើម</a>
                        </li>
                        @php
                        $navCategories = \App\Models\Category::all();
                        $catParam =
                        request()->route() && request()->route()->getName() === 'news.viewCategory'
                        ? request()->route()->parameter('categories')
                        : null;
                        $currentCategoryId =
                        $catParam instanceof \App\Models\Category
                        ? $catParam->id
                        : (is_numeric($catParam)
                        ? (int) $catParam
                        : null);
                        @endphp

                        @foreach ($navCategories as $cat)
                        <li class="nav-item">
                            <a href="{{ route('news.viewCategory', $cat->id) }}"
                                class="nav-link {{ $currentCategoryId === $cat->id ? 'active' : '' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="magnews-nav-right d-flex align-items-center gap-2 ms-auto">
                        <form action="{{ route('news.search') }}" method="GET" class="magnews-search-form"
                            id="navbarSearchForm">
                            <div class="magnews-search-wrapper">
                                <input type="text" class="magnews-search-input" name="q"
                                    id="navbarSearchInput" placeholder="Search" autocomplete="off"
                                    data-bs-target="#searchModal">
                                <button type="button" class="magnews-search-icon-btn" id="navbarSearchIcon">
                                    <i class="fas fa-search magnews-search-icon"></i>
                                </button>
                            </div>
                        </form>
                        {{-- <button class="magnews-contact-btn">Contact</button> --}}
                        <button class="magnews-theme-toggle-btn" type="button" id="themeToggleButton">
                            <i class="fas fa-moon"></i>
                        </button>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Breaking News Ticker -->
    <div class="magnews-breaking-news">
        <div class="container d-flex align-items-center p-0">
            <div class="breaking-title">
                ព័ត៌មានថ្មីៗ
            </div>
            <div class="breaking-content">
                <div class="breaking-ticker">
                    @php
                    $tickerNews = \App\Models\News::where('status', 'Accept')->latest()->take(10)->get();
                    @endphp
                    @foreach($tickerNews as $news)
                    <a href="{{ route('news.show', $news->id) }}" class="ticker-item">
                        <span class="ticker-separator">|</span>
                        {{ $news->title }}
                    </a>
                    @endforeach
                    {{-- Duplicate items for seamless loop --}}
                    @foreach($tickerNews as $news)
                    <a href="{{ route('news.show', $news->id) }}" class="ticker-item">
                        <span class="ticker-separator">|</span>
                        {{ $news->title }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->


    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay d-md-none" id="mobileMenuOverlay">
        <div class="d-flex flex-column" style="min-height: 100vh;">
            <!-- Top White Header with Logo and Close Button -->
            <div class="mobile-menu-header">
                <a href="{{ route('index') }}" class="mobile-menu-logo">
                    <img src="{{ asset('img/logo.png') }}" alt="KH News Logo" style="max-height: 60px;">
                </a>
                <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>


            <!-- Main Navigation Menu with Muted Green Background -->
            <ul class="mobile-menu-list flex-grow-1">
                <li class="mobile-menu-item">
                    <a href="{{ route('index') }}" class="mobile-menu-link">
                        <span>ទំព័រដើម</span>
                        <i class="fas fa-chevron-right mobile-menu-chevron"></i>
                    </a>
                </li>
                @foreach (\App\Models\Category::all() as $categories)
                <li class="mobile-menu-item">
                    <a href="{{ route('news.viewCategory', $categories->id) }}" class="mobile-menu-link">
                        <span>{{ $categories->name }}</span>
                        @if ($loop->last)
                        <i class="fas fa-chevron-right mobile-menu-chevron"></i>
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- Mobile Menu End -->

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen m-0">
            <div class="modal-content rounded-0 bg-transparent border-0">
                <div class="modal-body p-0">
                    <!-- Search bar in header style -->
                    <div class="magnews-search-modal-header w-100" style="padding: 15px 0;">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-3">
                                        <!-- Logo/Brand -->
                                        <div class="text-white fw-bold">ព័ត៏មាន</div>

                                        <!-- Search Input -->
                                        <div class="flex-grow-1 position-relative">
                                            <input type="search" id="searchInput"
                                                class="form-control border-0 ps-4 pe-5 py-2"
                                                placeholder="ស្វែងរកព័ត៌មាន..." style="border-radius: 25px;"
                                                autofocus />
                                            <span class="position-absolute end-0 top-50 translate-middle-y pe-3">
                                                <i class="fa fa-search text-muted"></i>
                                            </span>
                                        </div>

                                        <!-- Close Button -->
                                        <button type="button" class="search-modal-close-btn" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search Results Area -->
                    <div class="bg-white" style="min-height: calc(100vh - 80px);">
                        <div class="container py-4">
                            <!-- Loading indicator -->
                            <div id="searchLoading" class="text-center d-none">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2 text-muted">កំពុងស្វែងរក...</p>
                            </div>

                            <!-- Default message -->
                            <div id="searchDefault" class="text-center">
                                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                <p class="text-muted">បញ្ចូលពាក្យគន្លឹះដើម្បីស្វែងរកព័ត៌មាន...</p>
                            </div>

                            <!-- Search results -->
                            <div id="searchResults" class="d-none">
                                <div id="searchResultsHeader" class="mb-4">
                                    <h5 class="text-primary">លទ្ធផលស្វែងរក</h5>
                                    <p id="searchResultsCount" class="text-muted mb-0"></p>
                                </div>
                                <div id="searchResultsList" class="row g-4"></div>
                            </div>

                            <!-- No results message -->
                            <div id="noResults" class="text-center d-none">
                                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                <p class="text-muted">រកមិនឃើញព័ត៌មានដែលត្រូវនឹងការស្វែងរករបស់អ្នក</p>
                                <p class="text-muted">សូមព្យាយាមប្រើពាក្យគន្លឹះផ្សេង</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->

    @yield('content')

    <!-- Footer Start -->
    <footer class="magnews-footer">
        <div class="container">
            <div class="row">
                <!-- Left Column - About/Contact -->
                <div class="col-md-4 magnews-footer-column">
                    <div class="magnews-footer-logo mb-3">
                        <img src="{{ asset('img/logo.png') }}" alt="KH News Logo" style="max-height: 80px;">
                    </div>
                    <p class="magnews-footer-text mb-3">ប្រព័ន្ធផ្សព្វផ្សាយ ហ្វេសប៊ុក ទូរស័ព្ទ អ៊ីនធឺណិត
                    </p>
                    <p class="magnews-footer-contact mb-2"><i class="fas fa-phone me-2"></i>Phone: +855 855 481 01</p>
                    <p class="magnews-footer-contact mb-2"><i class="fas fa-envelope me-2"></i>Email:
                        sela168@gmail.com</p>
                    <div class="magnews-footer-social mt-3">
                        <a href="#" class="magnews-footer-social-icon" title="Facebook"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" class="magnews-footer-social-icon" title="Twitter"><i
                                class="fab fa-twitter"></i></a>
                        <a href="#" class="magnews-footer-social-icon" title="YouTube"><i
                                class="fab fa-youtube"></i></a>
                        <a href="#" class="magnews-footer-social-icon" title="Vimeo"><i
                                class="fab fa-vimeo-v"></i></a>
                        <a href="#" class="magnews-footer-social-icon" title="RSS"><i
                                class="fas fa-rss"></i></a>
                    </div>
                </div>
                <!-- Middle Column - Popular Posts -->
                <div class="col-md-4 magnews-footer-column">
                    <h5 class="magnews-footer-title mb-3">Popular Posts</h5>
                    @php
                    $popularPosts = \App\Models\News::where('status', 'Accept')
                    ->withCount('likes')
                    ->orderBy('likes_count', 'desc')
                    ->orderBy('views', 'desc')
                    ->take(3)
                    ->get();
                    @endphp
                    @foreach ($popularPosts as $post)
                    <div class="magnews-footer-post mb-3">
                        <div class="row g-2">
                            <div class="col-4">
                                <img src="{{ $post->image ? asset('storage/images/' . $post->image) : asset('img/noimg.jpg') }}"
                                    alt="{{ $post->title }}" class="magnews-footer-post-img">
                            </div>
                            <div class="col-8">
                                <a href="{{ route('news.show', $post->id) }}" class="magnews-footer-post-title">
                                    {{ Str::limit($post->title, 50) }}
                                </a>
                                <p class="magnews-footer-post-date mb-0">
                                    {{ $post->created_at->translatedFormat('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Right Column - Categories -->
                <div class="col-md-4 magnews-footer-column">
                    <h5 class="magnews-footer-title mb-3">Category</h5>
                    <ul class="magnews-footer-category-list">
                        @foreach (\App\Models\Category::orderBy('views', 'desc')->take(10)->get() as $category)
                        <li class="magnews-footer-category-item">
                            <a href="{{ route('news.viewCategory', $category->id) }}"
                                class="magnews-footer-category-link">
                                {{ $category->name }} <span
                                    class="magnews-footer-category-count">({{ $category->news()->where('status', 'Accept')->count() }})</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="magnews-footer-bottom">
            <div class="container">
                <p class="mb-0">Copyright © {{ date('Y') }} All rights reserved | This template is made with
                    love by Colorlib</p>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="back-to-top" id="back-to-top">
        <div class="back-to-top-square">
            <i class="fa fa-arrow-up"></i>
        </div>
    </a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4 /jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('th/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('th/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('th/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('th/js/main.js') }}"></script>

    {{-- Custom JS --}}
    <script src="{{ asset('js/shortcut.js') }}"></script>
    <script src="{{ asset('js/back-to-top.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>

    {{-- Navbar Search Functionality --}}
    <script>
        document.addEventListener('turbo:load', function() {
            const navbarSearchInput = document.getElementById('navbarSearchInput');
            const navbarSearchForm = document.getElementById('navbarSearchForm');
            const navbarSearchIcon = document.getElementById('navbarSearchIcon');
            let isModalOpening = false;

            // Handle Enter key press
            if (navbarSearchInput) {
                navbarSearchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const query = this.value.trim();
                        if (query !== '') {
                            // Submit form to search results page
                            navbarSearchForm.submit();
                        }
                    }
                });

                // Handle click on input - open modal if empty, otherwise allow typing
                navbarSearchInput.addEventListener('click', function(e) {
                    const query = this.value.trim();
                    if (query === '') {
                        // If empty, open modal
                        isModalOpening = true;
                        setTimeout(function() {
                            isModalOpening = false;
                        }, 300);
                    }
                });

                // Handle focus - allow typing
                navbarSearchInput.addEventListener('focus', function() {
                    this.removeAttribute('readonly');
                });
            }

            // Handle search icon click
            if (navbarSearchIcon) {
                navbarSearchIcon.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const query = navbarSearchInput.value.trim();
                    if (query !== '') {
                        // Submit form if there's a query
                        navbarSearchForm.submit();
                    } else {
                        // Open modal if empty
                        const modal = new bootstrap.Modal(document.getElementById('searchModal'));
                        modal.show();
                    }
                });
            }

            // Prevent form submission when clicking input (to allow modal opening)
            if (navbarSearchForm) {
                navbarSearchForm.addEventListener('submit', function(e) {
                    const query = navbarSearchInput.value.trim();
                    if (query === '' && !isModalOpening) {
                        e.preventDefault();
                        // Open modal if empty
                        const modal = new bootstrap.Modal(document.getElementById('searchModal'));
                        modal.show();
                    }
                });
            }
        });
    </script>

    {{-- Mobile Menu JS --}}
    <script>
        document.addEventListener('turbo:load', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            const mobileMenuClose = document.getElementById('mobileMenuClose');
            const mobileSearchInput = document.getElementById('mobileSearchInput');

            // Open mobile menu
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    mobileMenuOverlay.classList.add('active');
                    document.body.classList.add('mobile-menu-open');
                });
            }

            // Close mobile menu
            function closeMobileMenu() {
                mobileMenuOverlay.classList.remove('active');
                document.body.classList.remove('mobile-menu-open');
            }

            if (mobileMenuClose) {
                mobileMenuClose.addEventListener('click', closeMobileMenu);
            }

            // Close on overlay click (outside menu content)
            mobileMenuOverlay.addEventListener('click', function(e) {
                if (e.target === mobileMenuOverlay) {
                    closeMobileMenu();
                }
            });

            // Mobile search functionality - open search modal
            if (mobileSearchInput) {
                mobileSearchInput.addEventListener('focus', function() {
                    closeMobileMenu();
                    setTimeout(function() {
                        const searchModal = new bootstrap.Modal(document.getElementById(
                            'searchModal'));
                        searchModal.show();
                        document.getElementById('searchInput').focus();
                    }, 300);
                });
            }

            // Close menu on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && mobileMenuOverlay.classList.contains('active')) {
                    closeMobileMenu();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('turbo:load', function() {
            const body = document.body;
            const themeToggleButton = document.getElementById('themeToggleButton');
            const themeToggleButtonMobile = document.getElementById('themeToggleButtonMobile');
            const themeKey = 'khnews-theme';

            function applyTheme(theme) {
                if (theme === 'dark') {
                    body.classList.add('dark-mode');
                    if (themeToggleButton) {
                        themeToggleButton.classList.add('theme-toggle-active');
                        themeToggleButton.innerHTML = '<i class="fas fa-sun"></i>';
                    }
                    if (themeToggleButtonMobile) {
                        themeToggleButtonMobile.classList.add('theme-toggle-active');
                        themeToggleButtonMobile.innerHTML = '<i class="fas fa-sun"></i>';
                    }
                } else {
                    body.classList.remove('dark-mode');
                    if (themeToggleButton) {
                        themeToggleButton.classList.remove('theme-toggle-active');
                        themeToggleButton.innerHTML = '<i class="fas fa-moon"></i>';
                    }
                    if (themeToggleButtonMobile) {
                        themeToggleButtonMobile.classList.remove('theme-toggle-active');
                        themeToggleButtonMobile.innerHTML = '<i class="fas fa-moon"></i>';
                    }
                }
            }

            function getInitialTheme() {
                const stored = localStorage.getItem(themeKey);
                if (stored === 'light' || stored === 'dark') {
                    return stored;
                }
                if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    return 'dark';
                }
                return 'light';
            }

            let currentTheme = getInitialTheme();
            applyTheme(currentTheme);

            if (themeToggleButton) {
                themeToggleButton.addEventListener('click', function() {
                    currentTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    localStorage.setItem(themeKey, currentTheme);
                    applyTheme(currentTheme);
                });
            }
            if (themeToggleButtonMobile) {
                themeToggleButtonMobile.addEventListener('click', function() {
                    currentTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    localStorage.setItem(themeKey, currentTheme);
                    applyTheme(currentTheme);
                });
            }
        });
    </script>
</body>

</html>