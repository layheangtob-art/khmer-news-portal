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
        /* Enhanced CKEditor Styling - Matching Example Design */
        .editor-label {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .ck.ck-editor {
            border: 1px solid #e0e0e0;
            border-radius: 4px;
        }

        .ck.ck-toolbar {
            border-bottom: 1px solid #e0e0e0 !important;
            background: #fafafa;
            padding: 8px;
            border-radius: 4px 4px 0 0;
        }

        .ck.ck-content {
            min-height: 400px;
            padding: 20px;
            font-size: 14px;
            line-height: 1.6;
            border-radius: 0 0 4px 4px;
            background: #fff;
        }

        #toolbar-container {
            border: 1px solid #e0e0e0;
            border-radius: 4px 4px 0 0;
            background: #fafafa;
        }

        .editor-container {
            border: 1px solid #e0e0e0;
            border-top: none;
            border-radius: 0 0 4px 4px;
            background: #fff;
        }

        #word-count {
            background: #f8f9fa;
            padding: 8px 15px;
            border-top: 1px solid #e0e0e0;
            border-radius: 0 0 4px 4px;
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
                        <a>Create</a>
                    </li>
                </ul>
            </div>
            {{-- Content --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Create News</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data"
                                        id="form">
                                        @csrf
                                        <div class="col-12 mx-auto">
                                            <div class="form-group row">
                                                <label for="inlineinput" class="col-12 col-form-label">Title</label>
                                                <div class="col-12">
                                                    <input type="text" class="form-control input-full" id="inlineinput"
                                                        placeholder="Enter Input" name="title" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="editor" class="editor-label">News Body</label>
                                                <div id="toolbar-container"></div>
                                                <div class="editor-container">
                                                    <textarea
                                                        class="form-control col-12"
                                                        id="editor"
                                                        name="content"
                                                        style="border: none; outline: none;">
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Main Image</label>
                                                <input type="file" class="form-control" id="imageInput" name="image" accept="image/*" />
                                                <img id="imagePreview" src="#" alt="Preview"
                                                    style="max-width: 200px; display: none;" class="img-fluid mt-4">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Additional Images (Optional)</label>
                                                <input type="file" class="form-control" id="additionalImagesInput" name="additional_images[]" multiple accept="image/*" />
                                                <small class="form-text text-muted">You can select multiple images by holding Ctrl/Cmd while clicking</small>
                                                <div id="additionalImagesPreview" class="row mt-3"></div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleFormControlSelect1">Category</label>
                                                <select class="form-select" id="exampleFormControlSelect1"
                                                    name="category_id">
                                                    @foreach ($allCategory as $categories)
                                                        <option value="{{ $categories->id }}">{{ $categories->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 mt-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="isPinned" name="is_pinned" value="1">
                                                    <label class="form-check-label" for="isPinned">
                                                        Pin to Homepage
                                                    </label>
                                                    <small class="form-text text-muted d-block">Check this to pin this news title to the homepage</small>
                                                </div>
                                            </div>
                                            <div class="card-footer mt-3 d-flex justify-content-start">
                                                <button type="button" class="btn btn-success me-1"
                                                    id="CKsubmitButton">Submit</button>
                                                <button class="btn btn-danger" id="CKdiscardButton">Discard</button>
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

@section('custom-footer')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const formEl = document.getElementById('form');
    const submitBtn = document.getElementById('CKsubmitButton');
    const editorTextarea = document.getElementById('editor');

    async function handleSubmit(event) {
      event.preventDefault();

      // Get content from CKEditor if available, otherwise fallback to textarea
      let contentHtml = editorTextarea ? editorTextarea.value : '';
      try {
        if (window.editor && typeof window.editor.getData === 'function') {
          contentHtml = window.editor.getData();
        }
      } catch (e) { /* fallback will be used */ }

      const formData = new FormData(formEl);
      formData.set('content', contentHtml);

      const confirmResult = await Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        confirmButtonText: 'Yes, submit it!',
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
        try {
          data = await response.json();
        } catch (parseErr) {
          // If response is not JSON, still show success if status ok
          data = { success: response.ok };
        }

        if (response.ok && data.success) {
          await Swal.fire({
            icon: 'success',
            title: 'Success',
            text: (data && data.message) ? data.message : 'Successfully saved the data.',
            buttonsStyling: false,
            customClass: { confirmButton: 'btn btn-success' }
          });
          const redirectUrl = (data && data.redirect_url) ? data.redirect_url : '{{ route('dashboard') }}';
          window.location.href = redirectUrl;
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: (data && data.message) ? data.message : 'Something went wrong.',
            buttonsStyling: false,
            customClass: { confirmButton: 'btn btn-danger' }
          });
        }
      } catch (err) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: err?.message || 'Request failed.',
          buttonsStyling: false,
          customClass: { confirmButton: 'btn btn-danger' }
        });
      }
    }

    if (formEl) formEl.addEventListener('submit', handleSubmit);
    if (submitBtn) submitBtn.addEventListener('click', handleSubmit);
  });
</script>
@endsection
