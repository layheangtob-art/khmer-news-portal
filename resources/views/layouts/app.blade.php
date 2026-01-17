<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>KH News - ព័ត៌មានខ្មែរ</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Koulen&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/kh-news.png') }}">

    <link rel="" type="image/png" href="{{ asset('img/kh-news.png') }}">


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
    <link rel="stylesheet" href="{{ asset('css/ckeditor-content.css') }}">
</head>

<body>
    <div class="container-fluid sticky-top main-header-wrapper">
        <div class="container-fluid topbar d-none d-lg-block">
            <div class="container px-0">
                <div class="topbar-top d-flex align-items-center py-1">
                    <span class="topbar-label me-3">NEWS</span>
                    <div class="top-info flex-grow-1">
                        @php
                            $pinnedNews = \App\Models\News::where('status', 'Accept')
                                ->where('is_pinned', true)
                                ->latest()
                                ->get();
                            if ($pinnedNews->isEmpty()) {
                                $pinnedNews = \App\Models\News::where('status', 'Accept')
                                    ->withCount('likes')
                                    ->orderBy('likes_count', 'desc')
                                    ->take(2)
                                    ->get();
                            }
                        @endphp
                        @if ($pinnedNews->count() > 0)
                            <div id="note">
                                @foreach ($pinnedNews as $news)
                                    <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none me-3">
                                        <span class="topbar-text">
                                            {{ ' ' . trim($news->title) . ' ' }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid main-navbar">
            <div class="container px-0">
                <nav class="navbar navbar-dark navbar-expand-xl px-0">
                    <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center">
                        <img src="{{ asset('img/kh-news.png') }}" alt="KH News Logo" class="rounded"
                            style="max-width: 90px; height: auto;">
                    </a>

                    <button class="navbar-toggler d-xl-none" type="button" id="mobileMenuToggle">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse d-none d-xl-flex" id="navbarCollapse">
                        <div class="navbar-nav ms-auto align-items-center">
                            @foreach (\App\Models\Category::all() as $categories)
                                <a href="{{ route('news.viewCategory', $categories->id) }}"
                                    class="nav-item nav-link text-white px-3 py-2"
                                    style="font-family: 'koulen', 'Khmer OS Battambang', sans-serif; font-size: 16px; font-weight: 500;">
                                    {{ $categories->name }}
                                </a>
                            @endforeach

                            <button class="btn btn-light btn-sm rounded-circle ms-3" data-bs-toggle="modal"
                                data-bs-target="#searchModal" style="width: 35px; height: 35px;">
                                <i class="fas fa-search text-primary"></i>
                            </button>

                            <button class="btn btn-outline-light btn-sm rounded-circle ms-2" type="button"
                                id="themeToggleButton" style="width: 35px; height: 35px;">
                                <i class="fas fa-moon"></i>
                            </button>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

    </div>
    <!-- Navbar End -->

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay d-xl-none" id="mobileMenuOverlay">
        <div class="d-flex flex-column" style="min-height: 100vh;">
            <div class="mobile-menu-header">
                <div></div>
                <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <ul class="mobile-menu-list flex-grow-1">
                @foreach (\App\Models\Category::all() as $categories)
                    <li class="mobile-menu-item">
                        <a href="{{ route('news.viewCategory', $categories->id) }}" class="mobile-menu-link">
                            <span>{{ $categories->name }}</span>
                            @if ($loop->first)
                                <span class="expand-icon">+</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="mobile-menu-search">
                <div class="mobile-menu-search-wrapper">
                    <input type="text" class="mobile-menu-search-input" placeholder="ស្វែងរក..."
                        id="mobileSearchInput">
                    <i class="fas fa-search mobile-menu-search-icon"></i>
                </div>
            </div>
            <div class="mobile-menu-footer">
                <button type="button" class="mobile-theme-toggle-button" id="themeToggleButtonMobile">
                    <i class="fas fa-moon me-2"></i>
                    <span>Dark mode</span>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Menu End -->

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen m-0">
            <div class="modal-content rounded-0 bg-transparent border-0">
                <div class="modal-body p-0">
                    <!-- Search bar in header style -->
                    <div class="w-100" style="background-color: #0052A5; padding: 15px 0;">
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
                                        <button type="button" class="btn-close btn-close-white"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
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
    <footer class="admin-footer">
        <div class="container">
            <div class="row">
                <!-- Left Column - About/Contact -->
                <div class="col-md-6 footer-column">
                    <div class="mb-3">
                        <img src="{{ asset('img/kh-news.png') }}" style="max-width: 80px; margin-bottom: 10px;" alt="KH News Logo" class=" rounded ">
                        {{-- <h5 class="mb-3">ព័ត៌មាន</h5> --}}
                        <p class="mb-2">ប្រព័ន្ធផ្សព្វផ្សាយ ហ្វេសប៊ុក ទូរស័ព្ទ អ៊ីនធឺណិត និងការផ្សាយពាណិជ្ជកម្ម
                            ក្នុងស្រុក</p>
                        <p class="mb-1"><i class="fas fa-phone me-2"></i>ទូរស័ព្ទ: +855 855 481 01</p>
                        <p class="mb-1"><i class="fas fa-envelope me-2"></i>អ៊ីម៉ែល: sela168@gmail.com</p>
                        <p class="mb-3"><i class="fas fa-map-marker-alt me-2"></i>អាសយដ្ឋាន: ភ្នំពេញ, កម្ពុជា</p>
                    </div>
                    <div class="copyright-text">
                        <p class="mb-0">© {{ date('Y') }} - រក្សាសិទ្ធិគ្រប់យ៉ាងដោយ ព័ត៌មាន</p>
                    </div>
                </div>
                <!-- Right Column - Categories & Social Media -->
                <div class="col-md-6 footer-column">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">ប្រភេទព័ត៌មាន</h5>
                            <ul class="list-unstyled">
                                @foreach (\App\Models\Category::orderBy('views', 'desc')->take(6)->get() as $category)
                                    <li class="mb-2">
                                        <a href="{{ route('news.viewCategory', $category->id) }}"
                                            class="text-decoration-none">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">បណ្តាញសង្គម</h5>
                            <div class="social-icons mb-3">
                                <a href="#" class="me-3" title="Facebook"><i
                                        class="fab fa-facebook-f fa-lg"></i></a>
                                <a href="#" class="me-3" title="Telegram"><i
                                        class="fab fa-telegram fa-lg"></i></a>
                                <a href="#" class="me-3" title="YouTube"><i
                                        class="fab fa-youtube fa-lg"></i></a>
                                <a href="#" class="me-3" title="X (Twitter)"><i
                                        class="fab fa-x-twitter fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright">
        <div class="container">
            <p class="mb-0">© {{ date('Y') }} - រក្សាសិទ្ធិគ្រប់យ៉ាងដោយ ក្រុមហ៊ុនយើង</p>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="back-to-top" id="back-to-top">
        <div class="back-to-top-square">
            <i class="fa fa-arrow-up"></i>
        </div>
    </a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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

    {{-- Mobile Menu JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        document.addEventListener('DOMContentLoaded', function() {
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
                        themeToggleButtonMobile.innerHTML = '<i class="fas fa-sun me-2"></i><span>Light mode</span>';
                    }
                } else {
                    body.classList.remove('dark-mode');
                    if (themeToggleButton) {
                        themeToggleButton.classList.remove('theme-toggle-active');
                        themeToggleButton.innerHTML = '<i class="fas fa-moon"></i>';
                    }
                    if (themeToggleButtonMobile) {
                        themeToggleButtonMobile.classList.remove('theme-toggle-active');
                        themeToggleButtonMobile.innerHTML = '<i class="fas fa-moon me-2"></i><span>Dark mode</span>';
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
