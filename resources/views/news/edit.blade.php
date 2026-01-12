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
        
        #toolbar-container {
            border: 1px solid #e0e0e0;
            border-radius: 8px 8px 0 0;
            background: #fafafa;
        }
        
        .editor-container {
            border: 1px solid #e0e0e0;
            border-top: none;
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
                                    <form action="{{ request()->routeIs('admin.*') ? route('admin.news.update', $news->id) : route('news.update', $news->id) }}" method="POST"
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
                                                <label for="editor" class="col-12 mb-3">Content</label>
                                                {{-- CKEditor Toolbar Container --}}
                                                <div id="toolbar-container"></div>
                                                <div class="editor-container">
                                                    <textarea class="form-control col-12" id="editor" name="content" style="border: none; outline: none;">{{ $news->content }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Main Image</label>
                                                <input type="file" class="form-control" id="imageInput" name="image" accept="image/*" />
                                                <img id="imagePreview"
                                                    src="{{ $news->image ? asset('storage/images/' . $news->image) : '#' }}"
                                                    alt="Preview"
                                                    style="display: {{ $news->image ? 'block' : 'none' }}; max-width: 200px;"
                                                    class="img-fluid mt-4">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Additional Images (Optional)</label>
                                                <input type="file" class="form-control" id="additionalImagesInput" name="additional_images[]" multiple accept="image/*" />
                                                <small class="form-text text-muted">You can select multiple images by holding Ctrl/Cmd while clicking. This will replace all existing additional images.</small>
                                                
                                                {{-- Display existing additional images --}}
                                                @if($news->images && count($news->images) > 0)
                                                    <div class="mt-3">
                                                        <label class="form-label">Current Additional Images:</label>
                                                        <div class="row" id="existingImages">
                                                            @foreach($news->images as $image)
                                                                <div class="col-md-3 mb-3">
                                                                    <img src="{{ asset('storage/images/' . $image) }}" 
                                                                         class="img-fluid rounded" 
                                                                         style="max-width: 150px; height: 100px; object-fit: cover;">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                <div id="additionalImagesPreview" class="row mt-3"></div>
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
