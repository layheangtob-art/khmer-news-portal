@extends('layouts.app')

@section('content')

    <!-- Top Banner Section -->
    @if(isset($homeBanners) && $homeBanners->count() > 0)
    <div class="container mt-3">
        <div class="sponsor-cover p-3 rounded mb-3">
            @foreach($homeBanners->take(1) as $banner)
                @if($banner->url)
                    <a href="{{ $banner->url }}" target="_blank" rel="noopener">
                        <img src="{{ asset('storage/banners/' . $banner->image) }}"
                             alt="{{ $banner->title }}"
                             class="img-fluid w-100"
                             style="max-height: 300px;"
                             onerror="this.style.display='none';">
                    </a>
                @else
                    <img src="{{ asset('storage/banners/' . $banner->image) }}"
                         alt="{{ $banner->title }}"
                         class="img-fluid w-100"
                         style="max-height: 400px; object-fit: cover;"
                         onerror="this.style.display='none';">
                @endif
            @endforeach
        </div>
    </div>
    @endif

    <!-- Hero / Latest News Section -->
    <div class="container py-2">
        <div class="row ">
            <!-- Main Featured News (Left) -->
            <div class="col-lg-8">
                <div class="section-header mb-3 d-flex align-items-center justify-content-between">
                    <h3 class="section-title text-primary border-start border-5 border-primary ps-3 mb-0">ព័ត៌មានថ្មីៗ</h3>
                    <a href="{{ route('news.index') }}" class="text-muted text-decoration-none small">មើលទាំងអស់ <i class="fas fa-angle-right"></i></a>
                </div>

                @if($latestNews->count() > 0)
                    <!-- Big Hero Card -->
                    <div class="card border-0 shadow-sm overflow-hidden mb-4">
                        <div class="position-relative" style="height: 400px;">
                            <img src="{{ $latestNews->first()->image ? asset('storage/images/' . $latestNews->first()->image) : asset('img/noimg.jpg') }}"
                                 class="w-100 h-100"
                                 style="object-fit: cover;"
                                 alt="{{ $latestNews->first()->title }}">
                            <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                                <span class="badge bg-primary mb-2">{{ $latestNews->first()->category->name ?? 'News' }}</span>
                                <a href="{{ route('news.show', $latestNews->first()->id) }}" class="text-decoration-none">
                                    <h2 class="text-white fw-bold mb-2">{{ $latestNews->first()->title }}</h2>
                                </a>
                                <div class="text-white-50 small">
                                    <i class="far fa-calendar-alt me-2"></i>{{ $latestNews->first()->created_at->translatedFormat('d/m/Y') }}
                                    <span class="mx-2">•</span>
                                    <i class="far fa-eye me-2"></i>{{ $latestNews->first()->views }} views
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sub Hero Grid -->
                    <div class="row g-3">
                        @foreach($latestNews->slice(1, 2) as $news)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="row g-0 h-100">
                                    <div class="col-4">
                                        <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                             class="img-fluid rounded-start h-100"
                                             style="object-fit: cover;"
                                             alt="{{ $news->title }}">
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body py-2 pe-2">
                                            <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none">
                                                <h6 class="card-title fw-bold mb-2 line-clamp-2 news-title">
                                                    {{ Str::limit($news->title, 50) }}
                                                </h6>
                                            </a>
                                            <small class="text-muted">
                                                <i class="far fa-calendar-alt me-1"></i>{{ $news->created_at->translatedFormat('d/m/Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Popular / Trending (Right) -->
            <div class="col-lg-4">
                <div class="section-header mb-3 py-2">
                    <h3 class="section-title text-danger border-start border-5 border-danger ps-3 mb-0">ពេញនិយម</h3>
                </div>
                <div class="bg-white p-3 rounded shadow-sm">
                    @foreach($popularNews as $index => $news)
                    <div class="d-flex align-items-start mb-3 pb-3 border-bottom {{ $loop->last ? 'border-0 mb-0 pb-0' : '' }}">
                        <div class="me-3">
                            <span class="badge bg-light text-dark border fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">{{ $index + 1 }}</span>
                        </div>
                        <div class="flex-grow-1">
                            <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none">
                                <h6 class="mb-1 fw-bold line-clamp-2 news-title">
                                    {{ Str::limit($news->title, 60) }}
                                </h6>
                            </a>
                            <div class="d-flex justify-content-between align-items-center mt-1">
                                <small class="text-muted" style="font-size: 0.8rem;">
                                    <span class="badge bg-secondary me-1" style="font-size: 0.7rem;">{{ $news->category->name ?? 'News' }}</span>
                                    {{ $news->created_at->translatedFormat('d/m/Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Middle Banner -->

    @if(isset($homeBanners) && $homeBanners->count() > 1)
    <div class="container mt-4">
        <div class="sponsor-cover p-3 rounded mb-3">
            @foreach($homeBanners->slice(1, 1) as $banner)
                @if($banner->url)
                    <a href="{{ $banner->url }}" target="_blank" rel="noopener">
                        <img src="{{ asset('storage/banners/' . $banner->image) }}" alt="{{ $banner->title }}" class="img-fluid w-100" style="max-height: 300px; object-fit: cover;">
                    </a>
                @else
                    <img src="{{ asset('storage/banners/' . $banner->image) }}" alt="{{ $banner->title }}" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
                @endif
            @endforeach
        </div>
    </div>
    @endif

    <!-- News by Category (Tabbed Interface) -->
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center border-bottom pb-2">
                    <h3 class="section-title text-primary border-start border-5 border-primary ps-3 mb-3 mb-md-0">ព័ត៌មានតាមប្រភេទ</h3>

                    <!-- Scrollable Tabs for Mobile -->
                    <div class="overflow-auto w-100 w-md-auto ms-md-4">
                        <ul class="nav nav-pills flex-nowrap" id="categoryTabs" role="tablist">
                            <li class="nav-item me-2" role="presentation">
                                <button class="nav-link active rounded-pill px-4 text-nowrap" id="tab-all-btn" data-bs-toggle="pill" data-bs-target="#tab-all" type="button" role="tab" aria-selected="true">ទាំងអស់</button>
                            </li>
                            @foreach($categoriesWithNews as $category)
                            <li class="nav-item me-2" role="presentation">
                                <button class="nav-link rounded-pill px-4 text-nowrap" id="tab-{{ $category->id }}-btn" data-bs-toggle="pill" data-bs-target="#tab-{{ $category->id }}" type="button" role="tab" aria-selected="false">{{ $category->name }}</button>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content" id="categoryTabsContent">
            <!-- All Categories Tab (Shows a mix or grid of latest news) -->
            <div class="tab-pane fade show active" id="tab-all" role="tabpanel" aria-labelledby="tab-all-btn">
                <div class="row g-4">
                    @foreach($latestNews->take(8) as $news)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                            <div class="position-relative overflow-hidden" style="height: 200px;">
                                <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                     class="card-img-top w-100 h-100"
                                     style="object-fit: cover; transition: transform 0.3s;"
                                     onmouseover="this.style.transform='scale(1.1)'"
                                     onmouseout="this.style.transform='scale(1)'"
                                     alt="{{ $news->title }}">
                                <div class="position-absolute top-0 start-0 m-2">
                                    <span class="badge bg-primary">{{ $news->category->name ?? 'News' }}</span>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none mb-auto">
                                    <h5 class="card-title fw-bold line-clamp-2 news-title" style="font-size: 1.1rem;">
                                        {{ Str::limit($news->title, 60) }}
                                    </h5>
                                </a>
                                <div class="mt-3 d-flex justify-content-between align-items-center text-muted small">
                                    <span><i class="far fa-calendar-alt me-1"></i>{{ $news->created_at->translatedFormat('d/m/Y') }}</span>
                                    <span><i class="far fa-eye me-1"></i>{{ $news->views }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Specific Category Tabs -->
            @foreach($categoriesWithNews as $category)
            <div class="tab-pane fade" id="tab-{{ $category->id }}" role="tabpanel" aria-labelledby="tab-{{ $category->id }}-btn">
                <div class="row g-4">
                    @forelse($category->news as $news)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                            <div class="position-relative overflow-hidden" style="height: 200px;">
                                <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                     class="card-img-top w-100 h-100"
                                     style="object-fit: cover; transition: transform 0.3s;"
                                     onmouseover="this.style.transform='scale(1.1)'"
                                     onmouseout="this.style.transform='scale(1)'"
                                     alt="{{ $news->title }}">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none mb-auto">
                                    <h5 class="card-title fw-bold line-clamp-2 news-title" style="font-size: 1.1rem;">
                                        {{ Str::limit($news->title, 60) }}
                                    </h5>
                                </a>
                                <div class="mt-3 d-flex justify-content-between align-items-center text-muted small">
                                    <span><i class="far fa-calendar-alt me-1"></i>{{ $news->created_at->translatedFormat('d/m/Y') }}</span>
                                    <span><i class="far fa-eye me-1"></i>{{ $news->views }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">មិនមានព័ត៌មានសម្រាប់ប្រភេទនេះទេ</p>
                    </div>
                    @endforelse
                </div>

                @if($category->news->count() > 0)
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <a href="{{ route('news.viewCategory', $category->id) }}" class="btn btn-outline-primary rounded-pill px-4">
                            មើលព័ត៌មាន {{ $category->name }} ទាំងអស់ <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    <style>
        .hover-shadow:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        .transition-all {
            transition: all 0.3s ease;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        /* Custom scrollbar for tabs on mobile */
        .nav-pills {
            padding-bottom: 5px;
        }
        .nav-pills::-webkit-scrollbar {
            height: 4px;
        }
        .nav-pills::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .nav-pills::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 2px;
        }

        /* Responsive styles for mobile and tablet */
        @media (max-width: 768px) {
            .section-title {
                font-size: 18px !important;
            }

            .card-body h2 {
                font-size: 20px !important;
            }

            .card-body h5 {
                font-size: 16px !important;
            }

            .card-body h6 {
                font-size: 14px !important;
            }

            .sponsor-cover img {
                max-height: 200px !important;
            }

            .position-relative[style*="height: 400px"] {
                height: 250px !important;
            }

            .col-md-6 .card-body {
                padding: 10px !important;
            }

            .col-md-6 .col-4 {
                width: 30% !important;
            }

            .col-md-6 .col-8 {
                width: 70% !important;
            }
        }

        @media (max-width: 576px) {
            .section-title {
                font-size: 16px !important;
            }

            .card-body h2 {
                font-size: 18px !important;
            }

            .position-relative[style*="height: 400px"] {
                height: 200px !important;
            }

            .position-relative[style*="height: 200px"] {
                height: 150px !important;
            }

            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .section-title {
                font-size: 22px !important;
            }

            .position-relative[style*="height: 400px"] {
                height: 300px !important;
            }
        }

        /* iPad Pro specific styles */
        @media (min-width: 1024px) and (max-width: 1199px) {
            .section-title {
                font-size: 24px !important;
            }

            .position-relative[style*="height: 400px"] {
                height: 350px !important;
            }

            .card-body h2 {
                font-size: 24px !important;
            }

            .card-body h5 {
                font-size: 18px !important;
            }

            .sponsor-cover img {
                max-height: 300px !important;
            }
        }
    </style>
@endsection
