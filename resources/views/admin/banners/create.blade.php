@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add New Banner</h3>
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
                    <a>Create</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Banner Information</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title" class="form-label">Banner Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image" class="form-label">Banner Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*" required>
                                <small class="form-text text-muted">Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="url" class="form-label">Banner URL (Optional)</label>
                                <input type="url" class="form-control @error('url') is-invalid @enderror"
                                       id="url" name="url" value="{{ old('url') }}"
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
                                    <option value="home" {{ old('position') == 'home' ? 'selected' : '' }}>Home Page Only</option>
                                    <option value="detail" {{ old('position') == 'detail' ? 'selected' : '' }}>News Detail Page Only</option>
                                    <option value="both" {{ old('position') == 'both' ? 'selected' : '' }}>Both Pages</option>
                                </select>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sort_order" class="form-label">Sort Order <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}"
                                       min="0" required>
                                <small class="form-text text-muted">Lower numbers appear first</small>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', true) ? 'checked' : '' }}>
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
                                    <i class="fa fa-save"></i> Create Banner
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Preview</h5>
                    </div>
                    <div class="card-body">
                        <div id="imagePreview" class="text-center" style="display: none;">
                            <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px;">
                        </div>
                        <div id="noPreview" class="text-center text-muted">
                            <i class="fa fa-image fa-3x mb-2"></i>
                            <p>Select an image to see preview</p>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Guidelines</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><i class="fa fa-check text-success me-2"></i>Use high-quality images</li>
                            <li><i class="fa fa-check text-success me-2"></i>Recommended size: 1200x400px</li>
                            <li><i class="fa fa-check text-success me-2"></i>Keep file size under 2MB</li>
                            <li><i class="fa fa-check text-success me-2"></i>Use JPEG or PNG format</li>
                        </ul>
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
