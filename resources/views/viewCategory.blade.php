@extends('layouts.app')

@section('content')
    <!-- Banner Section -->
    @if(isset($categoryBanners) && $categoryBanners->count() > 0)
    <div class="container py-2 mb-3">
        @foreach($categoryBanners->take(1) as $banner)
            @if($banner->url)
                <a href="{{ $banner->url }}" target="_blank" rel="noopener">
                    <img src="{{ asset('storage/banners/' . $banner->image) }}"
                         alt="{{ $banner->title }}"
                         class="img-fluid w-100 rounded"
                         style="max-height: 200px; object-fit: cover;"
                         onerror="this.style.display='none';">
                </a>
            @else
                <img src="{{ asset('storage/banners/' . $banner->image) }}"
                     alt="{{ $banner->title }}"
                     class="img-fluid w-100 rounded"
                     style="max-height: 200px; object-fit: cover;"
                     onerror="this.style.display='none';">
            @endif
        @endforeach
    </div>
    @endif

    <!-- Category News Section Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content Column -->
                <div class="col-lg-8">
                    <!-- Category Title -->
                    <div class="mb-4">
                        <h1 class="category-title">{{ $categories->name }}</h1>
                    </div>

                    <!-- Featured News -->
                    @foreach ($latestNews->take(1) as $news)
                    <div class="position-relative mb-5">
                        <div class="news-featured-image">
                            <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                class="img-fluid w-100" alt="{{ $news->title }}" style="max-height: 500px; object-fit: cover;" />
                            <!-- Additional images indicator for featured news -->
                            @if($news->images && count($news->images) > 0)
                                <div class="position-absolute image-indicator text-white"
                                     style="bottom: 30px; right: 30px;">
                                    <i class="fas fa-images me-1"></i> +{{ count($news->images) }} more images
                                </div>
                            @endif
                            <!-- Featured News Content Overlay -->
                            <div class="featured-news-content">
                                <div class="featured-news-meta">
                                    <span class="badge">{{ $categories->name }}</span>
                                    <div class="text-muted">
                                        <i class="fa fa-calendar-alt me-1"></i>{{ $news->created_at->translatedFormat('d F Y') }}
                                    </div>
                                </div>
                                <h2><a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a></h2>
                                <p>{!! Str::limit(strip_tags($news->content), 200, '...') !!}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- News List -->
                    <div class="row">
                        @foreach ($categories->news()->where('status', 'Accept')->orderBy('created_at', 'desc')->get()->slice(1) as $news)
                        <div class="col-12">
                            <div class="news-item">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="position-relative h-100" style="min-height: 250px;">
                                            <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                                class="img-fluid w-100 h-100" alt="{{ $news->title }}" style="object-fit: cover;" />
                                            <div class="position-absolute" style="top: 15px; left: 15px;">
                                                <div class="d-flex">
                                                    <div class="flag-corner-blue"></div>
                                                    <div class="flag-corner-red"></div>
                                                </div>
                                            </div>
                                            <!-- Additional images indicator -->
                                            @if($news->images && count($news->images) > 0)
                                                <div class="position-absolute image-indicator text-white"
                                                     style="bottom: 15px; right: 15px;">
                                                    <i class="fas fa-images me-1"></i> +{{ count($news->images) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="news-item-content p-4">
                                            <div class="news-item-meta">
                                                <span class="text-primary">{{ $categories->name }}</span>
                                                <div class="text-muted">
                                                    <i class="fa fa-calendar-alt me-1"></i>{{ $news->created_at->translatedFormat('d F Y') }}
                                                </div>
                                            </div>
                                            <h4><a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a></h4>
                                            <p>{{ Str::limit(strip_tags($news->content), 180, '...') }}</p>
                                            <div class="news-item-stats">
                                                <div>
                                                    <i class="fa fa-eye"></i>
                                                    <span>{{ $news->views }}</span>
                                                </div>
                                                <div>
                                                    <i class="fa fa-thumbs-up"></i>
                                                    <span>{{ $news->likes->count() }}</span>
                                                </div>
                                                @if($news->images && count($news->images) > 0)
                                                    <div>
                                                        <i class="fas fa-images"></i>
                                                        <span>{{ count($news->images) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div class="col-lg-4 mt-5 mt-lg-0">
                    <div class="sticky-top" style="top: 115px; z-index: 900;">
                        <!-- Latest News Widget -->
                        <div class="section-header mb-3">
                            <h3 class="section-title text-primary border-start border-5 border-primary ps-3 mb-0">ព័ត៌មានថ្មីៗ</h3>
                        </div>
                        <div class="bg-white p-3 rounded shadow-sm mb-4">
                            @foreach($globalLatestNews as $news)
                            <div class="d-flex align-items-start mb-3 pb-3 border-bottom {{ $loop->last ? 'border-0 mb-0 pb-0' : '' }}">
                                <div class="me-3">
                                   <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                        class="rounded" style="width: 80px; height: 60px; object-fit: cover;" alt="{{ $news->title }}">
                                </div>
                                <div class="flex-grow-1">
                                    <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none">
                                        <h6 class="mb-1 fw-bold line-clamp-2 news-title" style="font-size: 0.9rem;">
                                            {{ Str::limit($news->title, 50) }}
                                        </h6>
                                    </a>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            <span class="badge bg-secondary me-1" style="font-size: 0.65rem;">{{ $news->category->name ?? 'News' }}</span>
                                            {{ $news->created_at->translatedFormat('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Popular News Widget -->
                        <div class="section-header mb-3">
                            <h3 class="section-title text-danger border-start border-5 border-danger ps-3 mb-0">ពេញនិយម</h3>
                        </div>
                        <div class="bg-white p-3 rounded shadow-sm">
                            @foreach($popularNews->take(5) as $index => $news)
                            <div class="d-flex align-items-start mb-3 pb-3 border-bottom {{ $loop->last ? 'border-0 mb-0 pb-0' : '' }}">
                                <div class="me-3">
                                    <span class="badge bg-light text-dark border fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">{{ $index + 1 }}</span>
                                </div>
                                <div class="flex-grow-1">
                                    <a href="{{ route('news.show', $news->id) }}" class="text-decoration-none">
                                        <h6 class="mb-1 fw-bold line-clamp-2 news-title" style="font-size: 0.9rem;">
                                            {{ Str::limit($news->title, 50) }}
                                        </h6>
                                    </a>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            <i class="far fa-eye me-1"></i>{{ $news->views }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Category News Section End -->
@endsection
