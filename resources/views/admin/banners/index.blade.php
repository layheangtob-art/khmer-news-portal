@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Sponsor Banners</h3>
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
                    <a href="">Banners</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item active">
                    <a>Manage</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Manage Sponsor Banners</h4>
                            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Add New Banner
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Position</th>
                                        <th>Sort Order</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Position</th>
                                        <th>Sort Order</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('storage/banners/' . $banner->image) }}" 
                                                 alt="{{ $banner->title }}" 
                                                 style="width: 80px; height: 50px; object-fit: cover;" 
                                                 class="rounded">
                                        </td>
                                        <td>{{ $banner->title }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ ucfirst($banner->position) }}</span>
                                        </td>
                                        <td>{{ $banner->sort_order }}</td>
                                        <td>
                                            <span class="badge {{ $banner->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $banner->created_at->format('m/d/Y H:i') }}</td>
                                        <td>
                                            <div class="form-button-action d-flex justify-content-center align-items-center">
                                                {{-- Toggle Status Button --}}
                                                <span data-bs-toggle="tooltip" title="Toggle Status">
                                                    <button type="button" class="btn btn-link btn-warning btn-lg toggle-status-btn"
                                                        data-id="{{ $banner->id }}"
                                                        data-url="{{ route('admin.banners.toggleStatus', $banner->id) }}">
                                                        <i class="fa fa-power-off"></i>
                                                    </button>
                                                </span>

                                                {{-- Edit Button --}}
                                                <span data-bs-toggle="tooltip" title="Edit">
                                                    <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                                        class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </span>
                                                
                                                {{-- Delete Button --}}
                                                <span data-bs-toggle="tooltip" title="Delete">
                                                    <button type="button" class="btn btn-link btn-danger btn-lg delete-banner-btn"
                                                        data-id="{{ $banner->id }}"
                                                        data-title="{{ $banner->title }}"
                                                        data-url="{{ route('admin.banners.destroy', $banner->id) }}">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </span>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteBannerModal" tabindex="-1" aria-labelledby="deleteBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBannerModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the banner: <strong id="bannerTitle"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteBannerForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-footer')
<script>
    $(document).ready(function() {
        $("#basic-datatables").DataTable({});

        // Handle delete button click
        $('.delete-banner-btn').on('click', function() {
            const bannerId = $(this).data('id');
            const bannerTitle = $(this).data('title');
            const deleteUrl = $(this).data('url');
            
            $('#bannerTitle').text(bannerTitle);
            $('#deleteBannerForm').attr('action', deleteUrl);
            $('#deleteBannerModal').modal('show');
        });

        // Handle toggle status button click
        $('.toggle-status-btn').on('click', function() {
            const toggleUrl = $(this).data('url');
            const button = $(this);
            
            $.ajax({
                url: toggleUrl,
                type: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                },
                error: function() {
                    alert('Error updating banner status');
                }
            });
        });
    });
</script>
@endsection