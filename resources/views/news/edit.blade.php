@extends('layouts.admin')

@section('custom-header')
{{-- CKEditor 5 - Latest Version --}}
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css" />
<script type="importmap">
    {
       "imports": {
           "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.js",
           "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.3.1/"
       }
   }
   </script>
<script type="module" src="{{ asset('js/ckeditor.js') }}"></script>
<script src="{{ asset('js/multipleImages.js') }}"></script>

<style>
    /* Enhanced CKEditor Styling */
    .ck.ck-editor {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
    }

    .ck.ck-toolbar {
        border-bottom: 1px solid #e0e0e0 !important;
        background: #fafafa;
        padding: 10px;
        border-radius: 8px 8px 0 0;
    }

    .ck.ck-content {
        min-height: 400px;
        padding: 20px;
        font-size: 14px;
        line-height: 1.6;
        border-radius: 0 0 8px 8px;
    }

    #word-count {
        background: #f8f9fa;
        padding: 8px 15px;
        border-top: 1px solid #e0e0e0;
        border-radius: 0 0 8px 8px;
        font-size: 12px;
    }
</style>
@section('custom-footer')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formEl = document.getElementById('form');
        const submitBtn = document.getElementById('CKsubmitButton');
        const editorTextarea = document.getElementById('editor');

        async function handleSubmit(event) {
            event.preventDefault();

            // Get content from CKEditor if available
            let contentHtml = editorTextarea ? editorTextarea.value : '';
            try {
                if (window.editor && typeof window.editor.getData === 'function') {
                    contentHtml = window.editor.getData();
                }
            } catch (e) {}

            const formData = new FormData(formEl);
            formData.set('content', contentHtml);

            // Client-side file size validation
            const maxSizeBytes = 2 * 1024 * 1024; // 2MB matches current PHP limit
            const imageFile = formData.get('image');
            const audioFile = formData.get('audio_file');

            if (imageFile && imageFile.size > maxSizeBytes) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: `The image file size (${(imageFile.size / 1024 / 1024).toFixed(2)}MB) exceeds the 2MB limit.`,
                    buttonsStyling: false,
                    customClass: { confirmButton: 'btn btn-danger' }
                });
                return;
            }

            if (audioFile && audioFile.size > maxSizeBytes) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: `The audio file size (${(audioFile.size / 1024 / 1024).toFixed(2)}MB) exceeds the 2MB limit.`,
                    buttonsStyling: false,
                    customClass: { confirmButton: 'btn btn-danger' }
                });
                return;
            }

            const confirmResult = await Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                confirmButtonText: 'Yes, update it!',
                showCancelButton: true,
                cancelButtonText: 'No, cancel',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success mx-1',
                    cancelButton: 'btn btn-secondary mx-1'
                },
            });

            if (!confirmResult.isConfirmed) return;

            try {
                const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch(formEl.getAttribute('action'), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    credentials: 'same-origin',
                    body: formData
                });

                let data = {};
                const contentType = response.headers.get("content-type");
                if (contentType && contentType.indexOf("application/json") !== -1) {
                    data = await response.json();
                } else {
                    const text = await response.text();
                    console.error('Non-JSON response:', text);
                    throw new Error(response.status === 413 ? 'The uploaded file is too large for the server.' : 'The server returned an unexpected response. Please check the file size.');
                }

                if (response.ok && data.success) {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message || 'News updated successfully.',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                    window.location.href = data.redirect_url || "{{ route('dashboard') }}";
                } else {
                    Swal.fire('Error', data.message || 'Something went wrong.', 'error');
                }
            } catch (err) {
                Swal.fire('Error', 'Request failed: ' + err.message, 'error');
            }
        }

        if (formEl) formEl.addEventListener('submit', handleSubmit);
        if (submitBtn) submitBtn.addEventListener('click', handleSubmit);
    });
</script>
@endsection

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">News</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.news.manage') }}">News</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item active">
                    <a>Edit</a>
                </li>
            </ul>
        </div>
        {{-- Content --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit News</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form id="form" action="{{ request()->routeIs('admin.*') ? route('admin.news.update', $news->id) : route('news.update', $news->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-12 mx-auto">
                                        <div class="form-group row">
                                            <label for="inlineinput" class="col-12 col-form-label">Title</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control input-full" id="inlineinput"
                                                    placeholder="Enter Input" name="title"
                                                    value="{{ $news->title }}" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="editor" class="mb-2">Content</label>
                                            <textarea class="form-control col-12" id="editor" name="content" style="border: none; outline: none;">{{ $news->content }}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Main Image</label>
                                            <input type="file" class="form-control" id="imageInput" name="image" accept="image/*" />
                                            <img id="imagePreview"
                                                src="{{ $news->image ? asset('storage/images/' . $news->image) : '#' }}"
                                                alt="Preview"
                                                @if($news->image)
                                            style="display: block; max-width: 200px;"
                                            @else
                                            style="display: none; max-width: 200px;"
                                            @endif
                                            class="img-fluid mt-4">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Audio Voice (Optional)</label>
                                            <input type="file" class="form-control" name="audio_file" accept="audio/mpeg,audio/mp3" />
                                            @if($news->audio)
                                            <div class="mt-2">
                                                <small class="text-success">Current audio: {{ $news->audio }}</small>
                                                <audio controls class="w-100 mt-1" style="height: 30px;">
                                                    <source src="{{ asset('storage/audio/' . $news->audio) }}" type="audio/mpeg">
                                                </audio>
                                            </div>
                                            @endif
                                            <small class="form-text text-muted">Optional. MP3 audio for this article (e.g. Khmer voice-over).</small>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleFormControlSelect1">Category</label>
                                            <select class="form-select" id="exampleFormControlSelect1"
                                                name="category_id">
                                                @foreach ($allCategory as $categories)
                                                <option value="{{ $categories->id }}"
                                                    {{ $news->category_id == $categories->id ? 'selected' : '' }}>
                                                    {{ $categories->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 mt-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="isPinned" name="is_pinned" value="1" {{ $news->is_pinned ? 'checked' : '' }}>
                                                <label class="form-check-label" for="isPinned">
                                                    Pin to Homepage
                                                </label>
                                                <small class="form-text text-muted d-block">Check this to pin this news title to the homepage</small>
                                            </div>
                                        </div>
                                        <div class="card-footer mt-3 d-flex justify-content-start">
                                            <button type="submit" id="CKsubmitButton"
                                                class="btn btn-success me-1">Submit</button>
                                            <button type="button" class="btn btn-danger" id="CKdiscardButton">Discard</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection