<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('admin/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&family=Koulen&display=swap" rel="stylesheet">

    @include('components.admin-header')
</head>

<body>
    <div class="wrapper">
        <!-- Sponsor Banner Header -->
        <div class="container-fluid leaderboard-banner py-2">
            <div class="container">
                <div class="d-flex justify-content-center">
                    <div class="leaderboard-ad">
                        <a href="#"><img src="{{ asset('img/sponsor-banner.svg') }}" alt="Sponsor Banner" class="img-fluid"></a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="{{ route('index') }}" class="logo">
                        {{-- <img src="{{ asset('admin/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                            class="navbar-brand" height="20" /> --}}
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Components</h4>
                        </li>
                        <li
                            class="nav-item {{ Route::is('admin.news.*') || (Route::is('news.*') && !Route::is('news.draft')) ? 'active' : '' }}">
                            <a data-bs-toggle="collapse" href="#news">
                                <i class="fas fa-newspaper"></i>
                                <p>News</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ Route::is('admin.news.*') || (Route::is('news.*') && !Route::is('news.draft')) ? 'show' : '' }}"
                                id="news">
                                <ul class="nav nav-collapse">
                                    @if (auth()->user()->hasRole('Super Admin'))
                                        <li>
                                            <a href="{{ route('admin.news.manage') }}">
                                                <span class="sub-item">Manage</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasRole('Editor') || auth()->user()->hasRole('Super Admin'))
                                        <li>
                                            <a href="{{ route('news.status') }}">
                                                <span class="sub-item">Status</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasRole('Writer') || auth()->user()->hasRole('Super Admin'))
                                        <li>
                                            <a href="{{ route('news.create') }}">
                                                <span class="sub-item">Create</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        @if (auth()->user()->hasRole('Super Admin'))
                            <li class="nav-item {{ Route::is('admin.category.*') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#category">
                                    <i class="fas fa-list"></i>
                                    <p>Category</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ Route::is('admin.category.*') ? 'show' : '' }}" id="category">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="{{ route('admin.category.manage') }}">
                                                <span class="sub-item">Manage</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item {{ Route::is('admin.banners.*') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#banners">
                                    <i class="fas fa-images"></i>
                                    <p>Sponsor Banners</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ Route::is('admin.banners.*') ? 'show' : '' }}" id="banners">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="{{ route('admin.banners.index') }}">
                                                <span class="sub-item">Manage Banners</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.banners.create') }}">
                                                <span class="sub-item">Add New Banner</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if (auth()->user()->hasRole('Writer') || auth()->user()->hasRole('Super Admin'))
                            <li
                                class="nav-item {{ Route::is('admin.users.*') || Route::is('news.draft') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#users">
                                    <i class="fas fa-users-cog"></i>
                                    <p>Users</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ Route::is('admin.users.*') || Route::is('news.draft') ? 'show' : '' }}"
                                    id="users">
                                    <ul class="nav nav-collapse">
                                        @if (auth()->user()->hasRole('Super Admin'))
                                            <li>
                                                <a href="{{ route('admin.users.manage') }}">
                                                    <span class="sub-item">Manage</span>
                                                </a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('news.draft') }}">
                                                <span class="sub-item">Draft</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{ route('index') }}" class="logo">
                            <img src="{{ asset('admin/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                                class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret me-4">
                                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification" id="unread-notification-count"></span>
                                </a>
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">
                                            @if (auth()->user()->notifications->count() > 0)
                                                You have notifications
                                            @else
                                                Nothing notifications
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center" id="notifications-container">
                                                {{-- JS --}}
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="{{ auth()->user()->image ? asset('storage/images/' . auth()->user()->image) : asset('img/user.png') }}"
                                            alt="Profile Picture" class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">{{ auth()->user()->name }}</span>
                                    </span>
                                </a>

                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="{{ auth()->user()->image ? asset('storage/images/' . auth()->user()->image) : asset('img/user.png') }}"
                                                        alt="Profile Picture" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4>{{ auth()->user()->name }}</h4>
                                                    <p class="text-muted">{{ auth()->user()->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider bg-light"></div>
                                            <a class="dropdown-item"
                                                href="{{ route('profile.edit', auth()->user()->id) }}">My
                                                Profile</a>
                                            <div class="dropdown-divider bg-light"></div>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Logout</button>
                                            </form>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            @yield('content')

            <!-- Footer -->
            <footer class="admin-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 footer-column">
                            <h5>អំពីយើង</h5>
                            <p>ប្រព័ន្ធផ្សព្វផ្សាយ ហ្វេសប៊ុក ទូរស័ព្ទ អ៊ីនធឺណិត និងការផ្សាយពាណិជ្ជកម្ម ក្នុងស្រុក</p>
                        </div>
                        <div class="col-md-2 footer-column">
                            <h5>ជំនួយ</h5>
                            <ul>
                                <li><a href="#">ទំព័រដើម</a></li>
                                <li><a href="#">ព័ត៌មាន</a></li>
                                <li><a href="#">ប្រភេទ</a></li>
                                <li><a href="#">ទំនាក់ទំនង</a></li>
                                <li><a href="#">ការងារ</a></li>
                            </ul>
                        </div>
                        <div class="col-md-2 footer-column">
                            <h5>ប្រភេទ</h5>
                            <ul>
                                <li><a href="#">សេដ្ឋកិច្ច</a></li>
                                <li><a href="#">នយោបាយ</a></li>
                                <li><a href="#">កីឡា</a></li>
                                <li><a href="#">បច្ចេកវិទ្យា</a></li>
                                <li><a href="#">ការអប់រំ</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 footer-column">
                            <h5>តាមដានយើង</h5>
                            <div class="social-icons mb-3">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                                <a href="#"><i class="fab fa-telegram"></i></a>
                            </div>
                            <div class="app-download">
                                <a href="#"><img src="https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png" alt="Google Play"></a>
                                <a href="#"><img src="https://developer.apple.com/app-store/marketing/guidelines/images/badge-download-on-the-app-store.svg" alt="App Store"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <div class="copyright">
                <div class="container">
                    <p class="mb-0">© 2020 - រក្សាសិទ្ធិគ្រប់យ៉ាងដោយ ក្រុមហ៊ុនយើង</p>
                </div>
            </div>
        </div>
    </div>

    @include('components.admin-footer')
</body>

</html>
