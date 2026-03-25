@extends('layouts.app')

@section('content')
<!-- Blog Detail Page Start -->
<div class="container-fluid py-4">
    <div class="container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb mb-0 magnews-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('news.viewCategory', $news->category->id) }}" class="text-decoration-none">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($news->title, 50) }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Main Content Column -->
            <div class="col-lg-8">
                <!-- Category Tag -->
                <div class="mb-3">
                    <span class="magnews-category-tag">{{ strtoupper($news->category->name) }}</span>
                </div>

                <!-- Article Title -->
                <h1 class="magnews-article-title mb-3">{{ $news->title }}</h1>

                <!-- Meta Information -->
                <div class="magnews-meta-info mb-4">
                    <span>By {{ $news->author->name ?? 'Admin' }}</span>
                    <span class="mx-2">-</span>
                    <span>{{ $news->created_at->translatedFormat('M d, Y') }}</span>
                    <span class="mx-2">-</span>
                    <span>{{ number_format($news->views) }} Views</span>
                    <span class="mx-2">-</span>
                    {{-- <span>0 Comment</span> --}}
                </div>

                <!-- Featured Image -->
                <div class="magnews-featured-image mb-4">
                    <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                        alt="{{ $news->title }}" class="img-fluid w-100">
                </div>

                <!-- Additional Images Gallery -->
                @if ($news->images && count($news->images) > 0)
                <div class="additional-images-gallery mb-4">
                    <div class="row g-2">
                        @foreach ($news->images as $index => $image)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="gallery-item position-relative overflow-hidden rounded shadow-sm">
                                <img src="{{ asset('storage/images/' . $image) }}"
                                    class="img-fluid w-100 gallery-image"
                                    alt="Additional image {{ $index + 1 }}"
                                    style="height: 180px; object-fit: cover; cursor: pointer; transition: all 0.3s ease;"
                                    data-bs-toggle="modal" data-bs-target="#imageGalleryModal"
                                    onclick="openGallery({{ $index }})">
                                <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                    style="background: rgba(0,0,0,0.5); opacity: 0; transition: opacity 0.3s ease;">
                                    <i class="fas fa-search-plus text-white fs-3"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Gallery Modal -->
                <div class="modal fade" id="imageGalleryModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content bg-dark">
                            <div class="modal-header border-0 bg-transparent">
                                <h5 class="modal-title text-white">
                                    <i class="fas fa-images me-2"></i>
                                    Image Gallery - <span id="modalImageCounter">1 of {{ count($news->images) }}</span>
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body p-0 text-center position-relative">
                                <div class="position-relative">
                                    <img id="modalMainImage" src="" class="img-fluid w-100" style="max-height: 70vh; object-fit: contain;">
                                    <button class="btn btn-dark btn-lg position-absolute top-50 start-0 translate-middle-y ms-3 rounded-circle"
                                        onclick="previousImage()" style="width: 50px; height: 50px;">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="btn btn-dark btn-lg position-absolute top-50 end-0 translate-middle-y me-3 rounded-circle"
                                        onclick="nextImage()" style="width: 50px; height: 50px;">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                <div class="bg-dark bg-opacity-75 p-3">
                                    <div class="d-flex justify-content-center gap-2 flex-wrap" id="thumbnailStrip">
                                        @foreach ($news->images as $thumbIndex => $thumbImage)
                                        <img src="{{ asset('storage/images/' . $thumbImage) }}"
                                            class="thumbnail-img rounded border border-2"
                                            style="width: 60px; height: 60px; object-fit: cover; cursor: pointer; opacity: 0.7; transition: all 0.3s ease;"
                                            onclick="showImage({{ $thumbIndex }})">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    let currentImageIndex = 0;
                    const images = @json(array_map(function($img) {
                        return asset('storage/images/'.$img);
                    }, $news->images));
                    const totalImages = images.length;

                    function openGallery(index) {
                        currentImageIndex = index;
                        showImage(index);
                    }

                    function showImage(index) {
                        currentImageIndex = index;
                        document.getElementById('modalMainImage').src = images[index];
                        document.getElementById('modalImageCounter').textContent = `${index + 1} of ${totalImages}`;
                        document.querySelectorAll('.thumbnail-img').forEach((thumb, i) => {
                            thumb.classList.toggle('active', i === index);
                        });
                    }

                    function nextImage() {
                        currentImageIndex = (currentImageIndex + 1) % totalImages;
                        showImage(currentImageIndex);
                    }

                    function previousImage() {
                        currentImageIndex = (currentImageIndex - 1 + totalImages) % totalImages;
                        showImage(currentImageIndex);
                    }

                    document.addEventListener('keydown', function(e) {
                        const modal = document.getElementById('imageGalleryModal');
                        if (modal.classList.contains('show')) {
                            if (e.key === 'ArrowRight') nextImage();
                            if (e.key === 'ArrowLeft') previousImage();
                            if (e.key === 'Escape') {
                                const modalInstance = bootstrap.Modal.getInstance(modal);
                                modalInstance.hide();
                            }
                        }
                    });
                </script>
                @endif

                <!-- Article Content -->
                <div class="magnews-article-content mb-4">
                    {!! $news->content !!}
                </div>

                {{-- <!-- Tags Section -->
                    <div class="magnews-tags-section mb-4">
                        <span class="magnews-tags-label">Tags:</span>
                        <a href="{{ route('news.viewCategory', $news->category->id) }}" class="magnews-tag">{{ $news->category->name }}</a>
                @if($news->category->name !== 'Technology')
                <a href="#" class="magnews-tag">Technology</a>
                @endif
                <a href="#" class="magnews-tag">Crafts</a>
            </div> --}}
            {{--
                    <!-- Share Buttons -->
                    <div class="magnews-share-section mb-5">
                        <span class="magnews-share-label">Share:</span>
                        @php
                            $shareUrl = url()->current();
                            $shareTitle = $news->title;
                        @endphp
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" class="magnews-share-btn magnews-share-facebook">
            <i class="fab fa-facebook-f"></i> Facebook
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareTitle) }}" target="_blank" class="magnews-share-btn magnews-share-twitter">
                <i class="fab fa-twitter"></i> Twitter
            </a>
            <a href="https://plus.google.com/share?url={{ urlencode($shareUrl) }}" target="_blank" class="magnews-share-btn magnews-share-google">
                <i class="fab fa-google-plus-g"></i> Google+
            </a>
            <a href="https://pinterest.com/pin/create/button/?url={{ urlencode($shareUrl) }}&description={{ urlencode($shareTitle) }}" target="_blank" class="magnews-share-btn magnews-share-pinterest">
                <i class="fab fa-pinterest"></i> Pinterest
            </a>
        </div> --}}

        {{-- <!-- Leave a Comment Section -->
                    <div class="magnews-comment-section">
                        <h3 class="magnews-comment-title mb-3">Leave a Comment</h3>
                        <p class="magnews-comment-note mb-4">Your email address will not be published. Required fields are marked *</p>
                        <form class="magnews-comment-form">
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment *</label>
                                <textarea class="form-control" id="comment" rows="5" required></textarea>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name *</label>
                                    <input type="text" class="form-control" id="name" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" class="form-control" id="website">
                                </div>
                            </div>
                            <button type="submit" class="btn magnews-comment-submit-btn">Post Comment</button>
                        </form>
                    </div> --}}

        <!-- You Might Also Like -->
        @if(isset($randomNews) && $randomNews->count() > 0)
        <div class="magnews-related-posts mt-5">
            <h4 class="magnews-related-title mb-4">ព័ត៌មានផ្សេងទៀត</h4>
            <div class="row g-4">
                @foreach ($randomNews as $relatedNews)
                <div class="col-lg-6">
                    <div class="magnews-related-post">
                        <img src="{{ $relatedNews->image ? asset('storage/images/' . $relatedNews->image) : asset('img/noimg.jpg') }}"
                            alt="{{ $relatedNews->title }}" class="magnews-related-img">
                        <div class="magnews-related-content">
                            <a href="{{ route('news.show', $relatedNews->id) }}" class="magnews-related-title-link">
                                {{ Str::limit($relatedNews->title, 60) }}
                            </a>
                            <p class="magnews-related-date mb-0">
                                {{ $relatedNews->category->name }} - {{ $relatedNews->created_at->translatedFormat('M d') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar Column -->
    <div class="col-lg-4 mt-5 mt-lg-0">
        <div class="magnews-sidebar">
            <!-- Category Widget -->
            <div class="magnews-sidebar-widget mb-4">
                <h5 class="magnews-sidebar-title">Category</h5>
                <ul class="magnews-sidebar-list">
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('news.viewCategory', $category->id) }}" class="magnews-sidebar-link">
                            {{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Archive Widget -->
            <div class="magnews-sidebar-widget mb-4">
                <h5 class="magnews-sidebar-title">Archive</h5>
                <ul class="magnews-sidebar-list">
                    @foreach($archives as $archive)
                    @php
                    $monthName = \Carbon\Carbon::create($archive->year, $archive->month, 1)->translatedFormat('F');
                    @endphp
                    <li>
                        <a href="#" class="magnews-sidebar-link">
                            {{ $monthName }} {{ $archive->year }} ({{ $archive->count }})
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Popular Post Widget -->
            <div class="magnews-sidebar-widget mb-4">
                <h5 class="magnews-sidebar-title">Popular Post</h5>
                <div class="magnews-popular-posts">
                    @foreach($popularPosts as $popularPost)
                    <div class="magnews-popular-post-item">
                        <img src="{{ $popularPost->image ? asset('storage/images/' . $popularPost->image) : asset('img/noimg.jpg') }}"
                            alt="{{ $popularPost->title }}" class="magnews-popular-img">
                        <div class="magnews-popular-content">
                            <a href="{{ route('news.show', $popularPost->id) }}" class="magnews-popular-title">
                                {{ Str::limit($popularPost->title, 50) }}
                            </a>
                            <p class="magnews-popular-date mb-0">
                                {{ $popularPost->category->name }} - {{ $popularPost->created_at->translatedFormat('M d') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Tags Widget -->
            <div class="magnews-sidebar-widget">
                <h5 class="magnews-sidebar-title">Tags</h5>
                <div class="magnews-tags-widget">
                    @foreach($categories->take(10) as $tagCategory)
                    <a href="{{ route('news.viewCategory', $tagCategory->id) }}" class="magnews-tag-small">{{ $tagCategory->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Blog Detail Page End -->

<style>
    /* Blog Detail Page Styles */
    .magnews-breadcrumb {
        font-size: 14px;
        font-family: 'Kantumruy Pro', sans-serif;
    }

    .magnews-breadcrumb .breadcrumb-item a {
        color: #666;
    }

    .magnews-breadcrumb .breadcrumb-item.active {
        color: #333;
    }

    .magnews-category-tag {
        display: inline-block;
        background-color: #e2162d;
        color: #ffffff;
        padding: 5px 15px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .magnews-article-title {
        font-size: 32px;
        font-weight: 700;
        line-height: 1.3;
        color: #333;
        font-family: 'Kantumruy Pro', sans-serif;
    }

    .magnews-meta-info {
        color: #666;
        font-size: 14px;
        font-family: 'Kantumruy Pro', sans-serif;
    }

    .magnews-featured-image {
        margin: 30px 0;
    }

    .magnews-featured-image img {
        border-radius: 4px;
    }

    .magnews-article-content {
        font-size: 16px;
        line-height: 1.8;
        color: #333;
        font-family: 'Kantumruy Pro', sans-serif;
    }

    .magnews-article-content img {
        max-width: 100% !important;
        height: auto !important;
    }

    .magnews-article-content figure.image {
        max-width: 100%;
        margin: 1em auto;
    }

    .magnews-article-content figure.media, 
    .magnews-article-content iframe {
        max-width: 100%;
    }

    .magnews-tags-section {
        padding: 20px 0;
        border-top: 1px solid #e0e0e0;
        border-bottom: 1px solid #e0e0e0;
    }

    .magnews-tags-label {
        font-weight: 600;
        margin-right: 10px;
        color: #333;
    }

    .magnews-tag {
        display: inline-block;
        background-color: #f5f5f5;
        color: #333;
        padding: 5px 15px;
        margin-right: 10px;
        margin-bottom: 5px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .magnews-tag:hover {
        background-color: #4CAF50;
        color: #ffffff;
    }

    .magnews-share-section {
        padding: 20px 0;
    }

    .magnews-share-label {
        font-weight: 600;
        margin-right: 15px;
        color: #333;
    }

    .magnews-share-btn {
        display: inline-block;
        padding: 8px 15px;
        margin-right: 10px;
        margin-bottom: 10px;
        border-radius: 4px;
        color: #ffffff;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .magnews-share-facebook {
        background-color: #3b5998;
    }

    .magnews-share-facebook:hover {
        background-color: #2d4373;
    }

    .magnews-share-twitter {
        background-color: #1da1f2;
    }

    .magnews-share-twitter:hover {
        background-color: #0d8bd9;
    }

    .magnews-share-google {
        background-color: #dd4b39;
    }

    .magnews-share-google:hover {
        background-color: #c23321;
    }

    .magnews-share-pinterest {
        background-color: #bd081c;
    }

    .magnews-share-pinterest:hover {
        background-color: #8c0615;
    }

    .magnews-comment-section {
        padding: 30px 0;
        border-top: 1px solid #e0e0e0;
    }

    .magnews-comment-title {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        font-family: 'Kantumruy Pro', sans-serif;
    }

    .magnews-comment-note {
        color: #666;
        font-size: 14px;
    }

    .magnews-comment-form .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .magnews-comment-form .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        padding: 10px 15px;
    }

    .magnews-comment-form .form-control:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    }

    .magnews-comment-submit-btn {
        background-color: #1a1a1a;
        color: #ffffff;
        border: none;
        padding: 12px 30px;
        border-radius: 4px;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .magnews-comment-submit-btn:hover {
        background-color: #333;
    }

    /* Sidebar Styles */
    .magnews-sidebar {
        position: sticky;
        top: 100px;
    }

    .magnews-sidebar-widget {
        background-color: #ffffff;
        padding: 25px;
        border: 1px solid #e0e0e0;
        margin-bottom: 30px;
    }

    .magnews-sidebar-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2162d;
        font-family: 'Kantumruy Pro', sans-serif;
    }

    .magnews-sidebar-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .magnews-sidebar-list li {
        margin-bottom: 10px;
    }

    .magnews-sidebar-link {
        color: #666;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
        display: block;
        padding: 5px 0;
        font-family: 'Kantumruy Pro', sans-serif;
    }

    .magnews-sidebar-link:hover {
        color: #4CAF50;
        padding-left: 5px;
    }

    .magnews-popular-posts {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .magnews-popular-post-item {
        display: flex;
        gap: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .magnews-popular-post-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .magnews-popular-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        flex-shrink: 0;
    }

    .magnews-popular-content {
        flex: 1;
    }

    .magnews-popular-title {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #333;
        text-decoration: none;
        margin-bottom: 5px;
        line-height: 1.4;
        transition: color 0.3s ease;
    }

    .magnews-popular-title:hover {
        color: #4CAF50;
    }

    .magnews-popular-date {
        font-size: 12px;
        color: #999;
    }

    .magnews-tags-widget {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .magnews-tag-small {
        display: inline-block;
        background-color: #f5f5f5;
        color: #333;
        padding: 5px 12px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 12px;
        transition: all 0.3s ease;
    }

    .magnews-tag-small:hover {
        background-color: #4CAF50;
        color: #ffffff;
    }

    .magnews-related-posts {
        padding-top: 30px;
        border-top: 1px solid #e0e0e0;
    }

    .magnews-related-title {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        font-family: 'Kantumruy Pro', sans-serif;
    }

    .magnews-related-post {
        display: flex;
        gap: 15px;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .magnews-related-post:hover {
        background-color: #f0f0f0;
    }

    .magnews-related-img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 4px;
        flex-shrink: 0;
    }

    .magnews-related-content {
        flex: 1;
    }

    .magnews-related-title-link {
        display: block;
        font-size: 16px;
        font-weight: 600;
        color: #333;
        text-decoration: none;
        margin-bottom: 8px;
        line-height: 1.4;
        transition: color 0.3s ease;
    }

    .magnews-related-title-link:hover {
        color: #4CAF50;
    }

    .magnews-related-date {
        font-size: 13px;
        color: #999;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1 !important;
    }

    .gallery-item:hover .gallery-image {
        transform: scale(1.05);
    }

    .thumbnail-img:hover {
        opacity: 1 !important;
        border-color: #4CAF50 !important;
    }

    .thumbnail-img.active {
        opacity: 1 !important;
        border-color: #4CAF50 !important;
        box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);
    }

    /* Dark Mode Support */
    body.dark-mode .magnews-article-title,
    body.dark-mode .magnews-comment-title,
    body.dark-mode .magnews-sidebar-title,
    body.dark-mode .magnews-related-title,
    body.dark-mode .magnews-article-content,
    body.dark-mode .magnews-article-content p,
    body.dark-mode .magnews-article-content span,
    body.dark-mode .magnews-article-content li,
    body.dark-mode .magnews-article-content strong,
    body.dark-mode .magnews-article-content b,
    body.dark-mode .magnews-article-content i,
    body.dark-mode .magnews-article-content em {
        color: #e5e7eb !important;
    }

    body.dark-mode .magnews-article-content a {
        color: #38bdf8 !important;
    }

    body.dark-mode .magnews-article-content a:hover {
        color: #7dd3fc !important;
    }

    body.dark-mode .magnews-meta-info,
    body.dark-mode .magnews-comment-note,
    body.dark-mode .magnews-sidebar-link,
    body.dark-mode .magnews-popular-date,
    body.dark-mode .magnews-related-date {
        color: #9ca3af;
    }

    body.dark-mode .magnews-sidebar-widget {
        background-color: #1a1a1a;
        border-color: #333;
    }

    body.dark-mode .magnews-sidebar-link {
        color: #cccccc;
    }

    body.dark-mode .magnews-popular-title,
    body.dark-mode .magnews-related-title-link {
        color: #e5e7eb;
    }

    body.dark-mode .magnews-tag,
    body.dark-mode .magnews-tag-small {
        background-color: #2a2a2a;
        color: #cccccc;
    }

    body.dark-mode .magnews-related-post {
        background-color: #1a1a1a;
    }

    body.dark-mode .magnews-comment-form .form-control {
        background-color: #1a1a1a;
        border-color: #333;
        color: #e5e7eb;
    }

    body.dark-mode .magnews-tags-section,
    body.dark-mode .magnews-comment-section,
    body.dark-mode .magnews-related-posts {
        border-color: #333;
    }
</style>
@endsection