@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Banner</h3>
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
                    <a href="{{ route('admin.banners.index') }}">Banners</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item active">
                    <a>Edit</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Banner Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="title" class="form-label">Banner Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $banner->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image" class="form-label">Banner Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*">
                                <small class="form-text text-muted">Leave empty to keep current image. Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="url" class="form-label">Banner URL (Optional)</label>
                                <input type="url" class="form-control @error('url') is-invalid @enderror" 
                                       id="url" name="url" value="{{ old('url', $banner->url) }}" 
                                       placeholder="https://example.com">
                                <small class="form-text text-muted">Leave empty if banner should not be clickable</small>
                                @error('url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="position" class="form-label">Display Position <span class="text-danger">*</span></label>
                                <select class="form-control @error('position') is-invalid @enderror" id="position" name="position" required>
                                    <option value="">Select Position</option>
                                    <option value="home" {{ old('position', $banner->position) == 'home' ? 'selected' : '' }}>Home Page Only</option>
                                    <option value="detail" {{ old('position', $banner->position) == 'detail' ? 'selected' : '' }}>News Detail Page Only</option>
                                    <option value="both" {{ old('position', $banner->position) == 'both' ? 'selected' : '' }}>Both Pages</option>
                                </select>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sort_order" class="form-label">Sort Order <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" 
                                       min="0" required>
                                <small class="form-text text-muted">Lower numbers appear first</small>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active (Display this banner)
                                    </label>
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-between">
                                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Back to List
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Update Banner
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Current Image</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/banners/' . $banner->image) }}" 
                             alt="{{ $banner->title }}" 
                             class="img-fluid rounded mb-3" 
                             style="max-height: 200px;"
                             id="currentImage">
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">New Image Preview</h5>
                    </div>
                    <div class="card-body">
                        <div id="imagePreview" class="text-center" style="display: none;">
                            <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                        <div id="noPreview" class="text-center text-muted">
                            <i class="fa fa-image fa-3x mb-2"></i>
                            <p>Select a new image to see preview</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-footer')
<script>
    $(document).ready(function() {
        // Image preview functionality
        $('#image').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImg').attr('src', e.target.result);
                    $('#imagePreview').show();
                    $('#noPreview').hide();
                }
                reader.readAsDataURL(file);
            } else {
                $('#imagePreview').hide();
                $('#noPreview').show();
            }
        });
    });
</script>
@endsection