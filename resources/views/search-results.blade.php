@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="container">
        <!-- Search Results Header -->
        <div class="mb-4">
            <h2 class="mb-3">Search Results</h2>
            @if(isset($query) && !empty($query))
                <p class="text-muted">
                    @if(isset($resultsArray) && is_array($resultsArray) && count($resultsArray) > 0)
                        Found {{ count($resultsArray) }} result(s) for "<strong>{{ $query }}</strong>"
                    @else
                        No results found for "<strong>{{ $query }}</strong>"
                    @endif
                </p>
            @endif
        </div>

        <!-- Search Results -->
        @if(isset($resultsArray) && is_array($resultsArray) && count($resultsArray) > 0)
            <div class="row g-4">
                @foreach($resultsArray as $result)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 search-result-card">
                            @if(isset($result['image']) && $result['image'])
                                <div class="position-relative" style="height: 180px; overflow: hidden;">
                                    <img src="{{ $result['image'] }}" 
                                         class="card-img-top w-100 h-100" 
                                         style="object-fit: cover;" 
                                         alt="{{ $result['title'] }}"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="card-img-top bg-light align-items-center justify-content-center" style="height: 180px; display: none;">
                                        <i class="fas fa-newspaper fa-2x text-muted"></i>
                                    </div>
                                </div>
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                    <i class="fas fa-newspaper fa-2x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-primary">{{ $result['category'] ?? 'News' }}</span>
                                    <small class="text-muted">{{ $result['created_at'] ?? '' }}</small>
                                </div>
                                <h6 class="card-title mb-2">
                                    @if(isset($result['match_type']) && $result['match_type'] === 'title')
                                        <i class="fas fa-star text-warning me-1" title="Title match"></i>
                                    @else
                                        <i class="fas fa-file-alt text-info me-1" title="Content match"></i>
                                    @endif
                                    <a href="{{ $result['url'] ?? '#' }}" class="text-decoration-none text-dark stretched-link">
                                        {!! isset($result['highlighted_title']) ? $result['highlighted_title'] : ($result['title'] ?? 'No Title') !!}
                                    </a>
                                </h6>
                                <p class="card-text text-muted small mb-2">{{ $result['content'] ?? '' }}</p>
                                <div class="mt-auto">
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i>{{ $result['author'] ?? 'Admin' }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- No Results -->
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h4 class="text-muted mb-3">No results found</h4>
                <p class="text-muted">Try searching with different keywords</p>
                <a href="{{ route('index') }}" class="btn btn-primary mt-3">Go to Home</a>
            </div>
        @endif

        <!-- Search Again -->
        <div class="mt-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Search Again</h5>
                    <form action="{{ route('news.search') }}" method="GET">
                        <div class="magnews-search-wrapper" style="max-width: 500px;">
                            <input type="text" 
                                   class="magnews-search-input" 
                                   name="q" 
                                   value="{{ $query ?? '' }}"
                                   placeholder="Search" 
                                   required
                                   style="width: 100%;">
                            <button type="submit" class="magnews-search-icon-btn">
                                <i class="fas fa-search magnews-search-icon"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .search-result-card {
        transition: all 0.3s ease;
    }

    .search-result-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.15) !important;
    }

    .search-result-card mark {
        background-color: #ffeb3b;
        padding: 2px 4px;
        border-radius: 2px;
    }
</style>
@endsection
