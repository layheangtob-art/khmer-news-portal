@extends('layouts.admin')

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
                    <a href="">News</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item active">
                    <a>Manage</a>
                </li>
            </ul>
        </div>
        {{-- Content --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Manage News</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Updated At</th>
                                        <th>Status</th>
                                        <th style="width: 5%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Updated At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($allNews as $news)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $news->id }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($news->title, 50) }}</td>
                                        <td>{{ $news->category->name ?? 'N/A' }}</td>
                                        <td>{{ $news->author->name ?? 'N/A' }}</td>
                                        <td>{{ $news->updated_at->translatedFormat('m/d/Y H:i') }}</td>
                                        <td class="text-center">
                                            <span
                                                class="{{ $news->status == 'Accept' ? 'badge bg-success' : ($news->status == 'Reject' ? 'badge bg-danger' : ($news->status == 'Pending' ? 'badge bg-warning' : '')) }}">
                                                {{ $news->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="form-button-action d-flex justify-content-center align-items-center">

                                                {{-- Edit Button - Show for Super Admin or news author --}}
                                                @if (auth()->user()->hasRole('Super Admin') || $news->user_id == auth()->id())
                                                <span data-bs-toggle="tooltip" title="Edit">
                                                    <a href="{{ route('admin.news.edit', $news->id) }}"
                                                        class="btn btn-link btn-primary btn-lg edit-news-btn">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </span>
                                                @endif

                                                {{-- Delete Button - Show for Super Admin or news author --}}
                                                @if (auth()->user()->hasRole('Super Admin') || $news->user_id == auth()->id())
                                                <span data-bs-toggle="tooltip" title="Delete">
                                                    <button type="button" class="btn btn-link btn-danger btn-lg delete-news-btn"
                                                        data-id="{{ $news->id }}"
                                                        data-title="{{ $news->title }}"
                                                        data-url="{{ route('admin.news.destroy', $news->id) }}">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        const table = $("#basic-datatables").DataTable({});

        // Delete handler with SweetAlert confirmation and AJAX
        $(document).on('click', '.delete-news-btn', async function (e) {
            e.preventDefault();
            const btn = this;
            const title = btn.getAttribute('data-title');
            const url = btn.getAttribute('data-url');

            const confirmResult = await Swal.fire({
                title: 'Delete this news?',
                text: title ? `\"${title}\" will be removed.` : 'This item will be removed.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-danger mx-1',
                    cancelButton: 'btn btn-secondary mx-1'
                }
            });

            if (!confirmResult.isConfirmed) return;

            try {
                const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const formData = new FormData();
                formData.append('_method', 'DELETE');
                formData.append('_token', csrf);

                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: formData
                });

                let data = {};
                try {
                    data = await response.json();
                } catch (_) {
                    data = { success: response.ok };
                }

                if (response.ok && (data.success ?? true)) {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Deleted',
                        text: (data.message ?? 'The news was deleted successfully.'),
                        buttonsStyling: false,
                        customClass: { confirmButton: 'btn btn-success' }
                    });
                    // Remove row from the DataTable
                    const row = $(btn).closest('tr');
                    table.row(row).remove().draw();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Delete failed',
                        text: (data.message ?? 'Unable to delete this item.'),
                        buttonsStyling: false,
                        customClass: { confirmButton: 'btn btn-danger' }
                    });
                }
            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Request error',
                    text: err?.message || 'Something went wrong while deleting.',
                    buttonsStyling: false,
                    customClass: { confirmButton: 'btn btn-danger' }
                });
            }
        });
    });
</script>
@endsection
