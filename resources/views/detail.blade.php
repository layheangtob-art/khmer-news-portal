@extends('layouts.app')

@section('content')
    <!-- Sponsor Banner for Detail Page -->
    @if ($detailBanners->count() > 0)
        <div class="container-fluid py-2 mb-3">
            <div class="container">
                <div class="sponsor-cover p-3 rounded">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="sponsor-logos d-flex flex-wrap justify-content-around align-items-center">
                                @foreach ($detailBanners as $banner)
                                    <div class="sponsor-logo mx-2 my-2">
                                        @if ($banner->url)
                                            <a href="{{ $banner->url }}" target="_blank" rel="noopener">
                                                <img src="{{ asset('storage/banners/' . $banner->image) }}"
                                                    alt="{{ $banner->title }}" class="img-fluid"
                                                    style="max-height: 200px; width: auto;">
                                            </a>
                                        @else
                                            <img src="{{ asset('storage/banners/' . $banner->image) }}"
                                                alt="{{ $banner->title }}" class="img-fluid"
                                                style="max-height: 200px; width: auto;">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Single Product Start -->
    <div class="container-fluid py-4">
        <div class="container">
            <ol style=" font-family: 'koulen', 'Khmer OS Muol Light', serif;" class="breadcrumb justify-content-start mb-4"
                style="font-size: 23px;">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" style="font-size: 23px;">ទំព័រដើម</a></li>
                <li class="breadcrumb-item active text-dark" style="font-size: 23px;">{{ $news->title }}</li>
            </ol>
            <div class="row g-4">
                <div class="col-12">

                    <div class="position-relative overflow-hidden mb-4" style="border-radius: 20px; box-shadow: 0 8px 30px rgba(0, 82, 165, 0.15);">
                        <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                            class="img-zoomin img-fluid w-100" alt="" style="border-radius: 20px;">
                        <div class="position-absolute text-white px-4 py-2 rounded"
                            style="top: 20px; right: 20px; background: linear-gradient(135deg, #0052a5 0%, #00a8ff 100%); box-shadow: 0 4px 15px rgba(0, 82, 165, 0.4); font-weight: 600;">
                            {{ $news->category->name }}
                        </div>
                    </div>

                    {{-- Additional Images Gallery --}}
                    @if ($news->images && count($news->images) > 0)
                        <div class="additional-images-gallery mb-4">
                            <h5 class="mb-3 fw-bold">
                                <i class="fas fa-images text-primary me-2"></i>
                                ({{ count($news->images)  }})
                            </h5>

                            {{-- Gallery Grid --}}
                            <div class="row g-2">
                                @foreach ($news->images as $index => $image)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <div class="gallery-item position-relative overflow-hidden rounded shadow-sm">
                                            <img src="{{ asset('storage/images/' . $image) }}"
                                                class="img-fluid w-100 gallery-image"
                                                alt="Additional image {{ $index + 1 }}"
                                                style="height: 180px; object-fit: cover; cursor: pointer; transition: all 0.3s ease;"
                                                data-bs-toggle="modal" data-bs-target="#imageGalleryModal"
                                                data-image="{{ asset('storage/images/' . $image) }}"
                                                data-index="{{ $index }}"
                                                onclick="openGallery({{ $index }})">

                                            {{-- Overlay --}}
                                            <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                                style="background: rgba(0,0,0,0.5); opacity: 0; transition: opacity 0.3s ease;">
                                                <i class="fas fa-search-plus text-white fs-3"></i>
                                            </div>

                                            {{-- Image Number Badge --}}
                                            <div class="position-absolute top-0 end-0 m-2">
                                                <span class="badge bg-dark bg-opacity-75 rounded-pill px-2 py-1">
                                                    {{ $index + 1 }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- View All Button if more than 8 images --}}
                            @if (count($news->images) > 8)
                                <div class="text-center mt-3">
                                    <button class="btn btn-outline-primary btn-sm" onclick="showAllImages()">
                                        <i class="fas fa-th-large me-2"></i>View All {{ count($news->images) }} Images
                                    </button>
                                </div>
                            @endif
                        </div>

                        {{-- Enhanced Gallery Modal --}}
                        <div class="modal fade" id="imageGalleryModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header border-0 bg-transparent">
                                        <h5 class="modal-title text-white">
                                            <i class="fas fa-images me-2"></i>
                                            Image Gallery - <span id="modalImageCounter">1 of
                                                {{ count($news->images) }}</span>
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white"
                                            data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-0 text-center position-relative">
                                        {{-- Main Image Display --}}
                                        <div class="position-relative">
                                            <img id="modalMainImage" src="" class="img-fluid w-100"
                                                style="max-height: 70vh; object-fit: contain;">

                                            {{-- Navigation Arrows --}}
                                            <button
                                                class="btn btn-dark btn-lg position-absolute top-50 start-0 translate-middle-y ms-3 rounded-circle"
                                                onclick="previousImage()" style="width: 50px; height: 50px;">
                                                <i class="fas fa-chevron-left"></i>
                                            </button>
                                            <button
                                                class="btn btn-dark btn-lg position-absolute top-50 end-0 translate-middle-y me-3 rounded-circle"
                                                onclick="nextImage()" style="width: 50px; height: 50px;">
                                                <i class="fas fa-chevron-right"></i>
                                            </button>
                                        </div>

                                        {{-- Thumbnail Strip --}}
                                        <div class="bg-dark bg-opacity-75 p-3">
                                            <div class="d-flex justify-content-center gap-2 flex-wrap" id="thumbnailStrip">
                                                @foreach ($news->images as $thumbIndex => $thumbImage)
                                                    <img src="{{ asset('storage/images/' . $thumbImage) }}"
                                                        class="thumbnail-img rounded border border-2"
                                                        style="width: 60px; height: 60px; object-fit: cover; cursor: pointer; opacity: 0.7; transition: all 0.3s ease;"
                                                        onclick="showImage({{ $thumbIndex }})"
                                                        data-index="{{ $thumbIndex }}">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 bg-transparent justify-content-center">
                                        <div class="text-white-50 small">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Use arrow keys or click thumbnails to navigate
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Gallery Styles --}}
                        <style>
                            .gallery-item:hover .gallery-overlay {
                                opacity: 1 !important;
                            }

                            .gallery-item:hover .gallery-image {
                                transform: scale(1.05);
                            }

                            .thumbnail-img:hover {
                                opacity: 1 !important;
                                border-color: #0d6efd !important;
                            }

                            .thumbnail-img.active {
                                opacity: 1 !important;
                                border-color: #0d6efd !important;
                                box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
                            }
                        </style>

                        {{-- Gallery JavaScript --}}
                        <script>
                            let currentImageIndex = 0;
                            const images = @json(array_map(function ($img) {
                                    return asset('storage/images/' . $img);
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

                                // Update thumbnail active state
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

                            function showAllImages() {
                                // Show all hidden images in the grid
                                document.querySelectorAll('.gallery-item').forEach(item => {
                                    item.style.display = 'block';
                                });
                            }

                            // Keyboard navigation
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

                    <div class="news-content-wrapper my-4">
                        {!! $news->content !!}
                    </div>
                    <div class="tab-class">
                        <div class="d-flex justify-content-between border-bottom mb-4">
                            <ul class="nav nav-pills d-inline-flex text-center">
                                <li class="nav-item mb-3">
                                    <h5 class="mt-2 me-3 mb-0">Tags:</h5>
                                </li>
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill active me-2" data-bs-toggle="pill">
                                        <span class="text-dark" style="width: 100px;">{{ $news->category->name }}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="d-flex align-items-center">
                                <form action="{{ route('news.like', $news->id) }}" method="POST">
                                    @csrf
                                    @if ($news->likes->where('device_id', session('device_id'))->count())
                                        <button type="submit" class="btn btn-square">
                                            <i class="fas fa-thumbs-up text-primary"></i>
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-square">
                                            <i class="far fa-thumbs-up text-primary"></i>
                                        </button>
                                    @endif
                                </form>
                                <span class="ms-1">{{ $news->likes->count() }}</span>
                            </div>
                        </div>

                        {{-- <div class="tab-content">
                            <div class="tab-pane fade show active">
                                <div class="row g-4 align-items-center">
                                    <div class="col-3">
                                        <img src="{{ $news->author->image ? asset('storage/images/' . $news->author->image) : asset('img/user.png') }}"
                                            class="img-fluid w-100 rounded" alt="">
                                    </div>
                                    <div class="col-9">
                                        <h1>{{ $news->author->name }}</h1>
                                        <p class="mb-0">{{ $news->author->bio }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>

                    <div class="bg-light rounded my-4 p-4" style="border-radius: 16px !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);">
                        <h4 class="mb-4" style="font-family: 'Kantumruy Pro', 'Khmer OS Muol Light', serif; font-weight: 700; color: #0052a5;">
                            <i class="fas fa-newspaper me-2"></i>You Might Also Like
                        </h4>
                        <div class="row g-4">
                            @foreach ($randomNews as $news)
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center p-3 bg-white rounded" style="border-radius: 12px !important; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); transition: all 0.3s ease; border: 1px solid rgba(0, 82, 165, 0.1);"
                                         onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 20px rgba(0, 82, 165, 0.15)'"
                                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0, 0, 0, 0.05)'">
                                        <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                            class="img-fluid rounded" alt=""
                                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px;">
                                        <div class="ms-3">
                                            <a href="{{ route('news.show', $news->id) }}"
                                                class="h5 mb-2 text-decoration-none" style="color: #1a1a1a; font-weight: 600; transition: color 0.3s ease; display: block;"
                                                onmouseover="this.style.color='#0052a5'"
                                                onmouseout="this.style.color='#1a1a1a'">{{ Str::limit($news->title, 60) }}</a>
                                            <p class="text-muted mt-2 mb-0" style="font-size: 13px;">
                                                <i class="fa fa-calendar-alt me-1 text-primary"></i>
                                                {{ $news->created_at->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                {{-- <div class="col-lg-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <div class="input-group w-100 mx-auto d-flex mb-4">
                                    <input type="search" class="form-control p-3" placeholder="keywords"
                                        aria-describedby="search-icon-1">
                                    <span id="search-icon-1" class="btn btn-primary input-group-text p-3"><i
                                            class="fa fa-search text-white"></i></span>
                                </div>

                                @component('components.col-2')
                                @endcomponent

                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Single Product End -->

    <script id="dsq-count-scr" src="//news-center-1.disqus.com/count.js" async></script>
@endsection
