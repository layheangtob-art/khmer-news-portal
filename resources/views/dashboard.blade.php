@extends('layouts.admin')

@section('content')
    <div class="main-content m-3">
        <br>
        <br>
        <br>
        <!-- Header Section -->
        <div class="dashboard-header mb-5">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6">
                        <div class="header-content">
                            <h1 class="dashboard-title">Dashboard</h1>
                            <p class="header-subtitle">Welcome back, <span class="highlight-name">{{ auth()->user()->name }}</span></p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <div class="header-stats">
                            <div class="stat-badge">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ now()->format('l, F j, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid px-4">
            @if (auth()->user()->hasRole('Super Admin'))
                <!-- Super Admin Dashboard -->
                <!-- KPI Cards -->
                <div class="row mb-4 g-3">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="stat-card stat-card-users">
                            <div class="stat-card-content">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-info">
                                    <h6 class="stat-label">Total Users</h6>
                                    <h3 class="stat-number">{{ $totalUsers }}</h3>
                                    <p class="stat-meta">
                                        <span class="badge badge-success">
                                            <i class="fas fa-arrow-up"></i> +{{ $totalUsersCurrentMonth }} this month
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="stat-card-footer">
                                <small>Active accounts</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="stat-card stat-card-news">
                            <div class="stat-card-content">
                                <div class="stat-icon">
                                    <i class="far fa-newspaper"></i>
                                </div>
                                <div class="stat-info">
                                    <h6 class="stat-label">Total News</h6>
                                    <h3 class="stat-number">{{ $totalNews }}</h3>
                                    <p class="stat-meta">
                                        <span class="badge badge-info">
                                            <i class="fas fa-arrow-up"></i> +{{ $totalNewsCurrentMonth }} this month
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="stat-card-footer">
                                <small>Published articles</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="stat-card stat-card-published">
                            <div class="stat-card-content">
                                <div class="stat-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="stat-info">
                                    <h6 class="stat-label">Published</h6>
                                    <h3 class="stat-number">{{ $totalNewsAccepted }}</h3>
                                    <p class="stat-meta">
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i> Approved
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="stat-card-footer">
                                <small>Live articles</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="stat-card stat-card-pending">
                            <div class="stat-card-content">
                                <div class="stat-icon">
                                    <i class="fas fa-hourglass-half"></i>
                                </div>
                                <div class="stat-info">
                                    <h6 class="stat-label">Pending</h6>
                                    <h3 class="stat-number">{{ $totalNewsNotAccepted }}</h3>
                                    <p class="stat-meta">
                                        <span class="badge badge-warning">
                                            <i class="fas fa-clock"></i> Awaiting approval
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="stat-card-footer">
                                <small>Under review</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row mb-4 g-3">
                    <div class="col-lg-8">
                        <div class="chart-card">
                            <div class="card-header-custom">
                                <h5 class="card-title">Monthly Growth Trends</h5>
                                <p class="card-subtitle">Users & News statistics</p>
                            </div>
                            <div class="card-body p-4">
                                <div class="chart-container">
                                    <canvas id="multipleBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="chart-card">
                            <div class="card-header-custom">
                                <h5 class="card-title">News Status Distribution</h5>
                                <p class="card-subtitle">Content overview</p>
                            </div>
                            <div class="card-body p-4 d-flex align-items-center justify-content-center">
                                <div class="chart-container-pie">
                                    <canvas id="pieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif (auth()->user()->hasRole('Writer'))
                <!-- Writer Dashboard -->
                <div class="row mb-4 g-3">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="stat-card stat-card-success">
                            <div class="stat-card-content">
                                <div class="stat-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="stat-info">
                                    <h6 class="stat-label">Published</h6>
                                    <h3 class="stat-number">
                                        {{ auth()->user()->news()->where('status', 'Accept')->count() }}
                                    </h3>
                                    <p class="stat-meta">
                                        <span class="badge badge-success">
                                            <i class="fas fa-arrow-up"></i> Your approved articles
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="stat-card stat-card-warning">
                            <div class="stat-card-content">
                                <div class="stat-icon">
                                    <i class="fas fa-hourglass-half"></i>
                                </div>
                                <div class="stat-info">
                                    <h6 class="stat-label">Pending Review</h6>
                                    <h3 class="stat-number">
                                        {{ auth()->user()->news()->where('status', 'Pending')->count() }}
                                    </h3>
                                    <p class="stat-meta">
                                        <span class="badge badge-warning">
                                            <i class="fas fa-clock"></i> Awaiting editor
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="stat-card stat-card-danger">
                            <div class="stat-card-content">
                                <div class="stat-icon">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <div class="stat-info">
                                    <h6 class="stat-label">Rejected</h6>
                                    <h3 class="stat-number">
                                        {{ auth()->user()->news()->where('status', 'Reject')->count() }}
                                    </h3>
                                    <p class="stat-meta">
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times"></i> Needs revision
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <div class="info-content">
                                <h5>Quick Tips for Success</h5>
                                <p>Keep your articles engaging and newsworthy. Editors prefer well-researched content with clear headlines and proper formatting.</p>
                            </div>
                            <a href="{{ route('news.create') }}" class="btn btn-sm btn-primary">Create New Article</a>
                        </div>
                    </div>
                </div>

            @elseif (auth()->user()->hasRole('Editor'))
                <!-- Editor Dashboard -->
                <div class="row mb-4 g-3">
                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="stat-card stat-card-info">
                            <div class="stat-card-content">
                                <div class="stat-icon">
                                    <i class="far fa-newspaper"></i>
                                </div>
                                <div class="stat-info">
                                    <h6 class="stat-label">Total Articles</h6>
                                    <h3 class="stat-number">{{ $totalNews }}</h3>
                                    <p class="stat-meta">
                                        <span class="badge badge-info">
                                            <i class="fas fa-database"></i> All articles in system
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="stat-card stat-card-warning">
                            <div class="stat-card-content">
                                <div class="stat-icon">
                                    <i class="fas fa-spinner"></i>
                                </div>
                                <div class="stat-info">
                                    <h6 class="stat-label">Under Review</h6>
                                    <h3 class="stat-number">{{ $totalNewsNotAccepted }}</h3>
                                    <p class="stat-meta">
                                        <span class="badge badge-warning">
                                            <i class="fas fa-hourglass-half"></i> Awaiting approval
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div class="action-content">
                                <h5>Content Moderation Hub</h5>
                                <p>Review and manage pending articles. Ensure all content meets our publishing standards.</p>
                            </div>
                            <a href="{{ route('news.status') }}" class="btn btn-sm btn-primary">Review Articles</a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Pinned News Section --}}
            @if(isset($pinnedNews) && $pinnedNews->count() > 0)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-thumbtack text-warning me-2"></i>Pinned News on Homepage
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pinnedNews as $news)
                                        <tr>
                                            <td>
                                                <strong>{{ Str::limit($news->title, 60) }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $news->category->name ?? 'N/A' }}</span>
                                            </td>
                                            <td>{{ $news->author->name ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge {{ $news->status == 'Accept' ? 'bg-success' : ($news->status == 'Reject' ? 'bg-danger' : 'bg-warning') }}">
                                                    {{ $news->status }}
                                                </span>
                                            </td>
                                            <td>{{ $news->created_at->translatedFormat('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    @if (auth()->user()->hasRole('Super Admin') || $news->user_id == auth()->id())
                                                        <a href="{{ route('news.edit', $news->id) }}" class="btn btn-outline-primary" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('news.show', $news->id) }}" class="btn btn-outline-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
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
            @endif

            {{-- News Dashboard Section --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="news-dashboard-card">
                        <div class="news-dashboard-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mb-1"><i class="fas fa-newspaper me-2"></i>News Management</h4>
                                    <p class="text-muted mb-0">Quick access to your news articles</p>
                                </div>
                                <div class="news-dashboard-actions">
                                    @if (auth()->user()->hasRole('Writer') || auth()->user()->hasRole('Super Admin'))
                                        <a href="{{ route('news.create') }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus me-1"></i>Create News
                                        </a>
                                    @endif
                                    @if (auth()->user()->hasRole('Super Admin'))
                                        <a href="{{ route('admin.news.manage') }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-cog me-1"></i>Manage All
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="news-dashboard-body">
                            @if (auth()->user()->hasRole('Writer') && isset($userNews) && $userNews->count() > 0)
                                {{-- Writer's News Section --}}
                                <div class="mb-4">
                                    <h5 class="mb-3">My Recent Articles</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover news-dashboard-table">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Status</th>
                                                    <th>Created</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($userNews as $news)
                                                    <tr>
                                                        <td>
                                                            <div class="news-title-cell">
                                                                <strong>{{ Str::limit($news->title, 50) }}</strong>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-info">{{ $news->category->name }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge {{ $news->status == 'Accept' ? 'bg-success' : ($news->status == 'Reject' ? 'bg-danger' : 'bg-warning') }}">
                                                                {{ $news->status }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $news->created_at->translatedFormat('M d, Y') }}</td>
                                                        <td>
                                                            <div class="btn-group btn-group-sm">
                                                                @if (auth()->user()->hasRole('Super Admin') || $news->user_id == auth()->id())
                                                                    <a href="{{ route('news.edit', $news->id) }}" class="btn btn-outline-primary" title="Edit">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                @endif
                                                                <a href="{{ route('news.view', $news->id) }}" class="btn btn-outline-info" title="View">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            {{-- Recent News Section (for Super Admin and Editor) --}}
                            @if ((auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Editor')) && isset($recentNews) && $recentNews->count() > 0)
                                <div>
                                    <h5 class="mb-3">Recent News Articles</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover news-dashboard-table">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Author</th>
                                                    <th>Category</th>
                                                    <th>Status</th>
                                                    <th>Created</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recentNews as $news)
                                                    <tr>
                                                        <td>
                                                            <div class="news-title-cell">
                                                                <strong>{{ Str::limit($news->title, 50) }}</strong>
                                                            </div>
                                                        </td>
                                                        <td>{{ $news->author->name }}</td>
                                                        <td>
                                                            <span class="badge bg-info">{{ $news->category->name }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge {{ $news->status == 'Accept' ? 'bg-success' : ($news->status == 'Reject' ? 'bg-danger' : 'bg-warning') }}">
                                                                {{ $news->status }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $news->created_at->translatedFormat('M d, Y') }}</td>
                                                        <td>
                                                            <div class="btn-group btn-group-sm">
                                                                @if (auth()->user()->hasRole('Super Admin') || $news->user_id == auth()->id())
                                                                    <a href="{{ route('admin.news.edit', $news->id) }}" class="btn btn-outline-primary" title="Edit">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                @endif
                                                                <a href="{{ route('news.view', $news->id) }}" class="btn btn-outline-info" title="View">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            @if ((!isset($userNews) || $userNews->count() == 0) && (!isset($recentNews) || $recentNews->count() == 0))
                                <div class="text-center py-5">
                                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No news articles found.</p>
                                    @if (auth()->user()->hasRole('Writer') || auth()->user()->hasRole('Super Admin'))
                                        <a href="{{ route('news.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i>Create Your First Article
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --danger-gradient: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
            --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .dashboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 1.5rem;
            border-radius: 0;
            margin: 0 0 2rem 0;
            width: 100%;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
        }

        .highlight-name {
            font-weight: 600;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
        }

        .header-stats {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .stat-badge {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            backdrop-filter: blur(10px);
        }

        /* Stat Cards */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .stat-card.stat-card-users::before {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-card.stat-card-news::before {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stat-card.stat-card-published::before {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .stat-card.stat-card-pending::before {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .stat-card.stat-card-success::before {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .stat-card.stat-card-warning::before {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stat-card.stat-card-danger::before {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        }

        .stat-card.stat-card-info::before {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .stat-card-content {
            display: flex;
            gap: 1.5rem;
        }

        .stat-icon {
            font-size: 2.5rem;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            color: #667eea;
            flex-shrink: 0;
        }

        .stat-card.stat-card-users .stat-icon {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            color: #667eea;
        }

        .stat-card.stat-card-news .stat-icon {
            background: linear-gradient(135deg, rgba(240, 147, 251, 0.1), rgba(245, 87, 108, 0.1));
            color: #f093fb;
        }

        .stat-card.stat-card-published .stat-icon {
            background: linear-gradient(135deg, rgba(17, 153, 142, 0.1), rgba(56, 239, 125, 0.1));
            color: #11998e;
        }

        .stat-card.stat-card-pending .stat-icon {
            background: linear-gradient(135deg, rgba(250, 112, 154, 0.1), rgba(254, 225, 64, 0.1));
            color: #fa709a;
        }

        .stat-card.stat-card-success .stat-icon {
            background: linear-gradient(135deg, rgba(17, 153, 142, 0.1), rgba(56, 239, 125, 0.1));
            color: #11998e;
        }

        .stat-card.stat-card-warning .stat-icon {
            background: linear-gradient(135deg, rgba(240, 147, 251, 0.1), rgba(245, 87, 108, 0.1));
            color: #f093fb;
        }

        .stat-card.stat-card-danger .stat-icon {
            background: linear-gradient(135deg, rgba(235, 51, 73, 0.1), rgba(245, 92, 67, 0.1));
            color: #eb3349;
        }

        .stat-card.stat-card-info .stat-icon {
            background: linear-gradient(135deg, rgba(79, 172, 254, 0.1), rgba(0, 242, 254, 0.1));
            color: #4facfe;
        }

        .stat-info {
            flex: 1;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .stat-meta {
            margin: 0;
        }

        .stat-meta .badge {
            font-size: 0.75rem;
            padding: 0.4rem 0.8rem;
            font-weight: 500;
        }

        .badge-success {
            background: rgba(17, 153, 142, 0.15);
            color: #11998e;
        }

        .badge-info {
            background: rgba(79, 172, 254, 0.15);
            color: #4facfe;
        }

        .badge-warning {
            background: rgba(240, 147, 251, 0.15);
            color: #f093fb;
        }

        .badge-danger {
            background: rgba(235, 51, 73, 0.15);
            color: #eb3349;
        }

        .stat-card-footer {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .stat-card-footer small {
            color: #999;
            font-size: 0.85rem;
        }

        /* Chart Cards */
        .chart-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .chart-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .card-header-custom {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            background: rgba(0, 0, 0, 0.01);
        }

        .card-header-custom .card-title {
            margin: 0 0 0.5rem 0;
            font-size: 1.2rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .card-header-custom .card-subtitle {
            margin: 0;
            font-size: 0.9rem;
            color: #999;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .chart-container-pie {
            position: relative;
            height: 250px;
        }

        /* Info Cards */
        .info-card,
        .action-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .info-card:hover,
        .action-card:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .info-icon,
        .action-icon {
            font-size: 3rem;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            color: #667eea;
            flex-shrink: 0;
        }

        .action-icon {
            background: linear-gradient(135deg, rgba(79, 172, 254, 0.1), rgba(0, 242, 254, 0.1));
            color: #4facfe;
        }

        .info-content h5,
        .action-content h5 {
            margin: 0 0 0.5rem 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .info-content p,
        .action-content p {
            margin: 0;
            color: #666;
            font-size: 0.95rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-header {
                padding: 2rem 1rem;
            }

            .dashboard-title {
                font-size: 2rem;
            }

            .header-stats {
                justify-content: flex-start;
                margin-top: 1rem;
            }

            .stat-card {
                padding: 1.25rem;
            }

            .stat-card-content {
                flex-direction: column;
            }

            .stat-icon {
                width: 60px;
                height: 60px;
                font-size: 2rem;
            }

            .stat-number {
                font-size: 1.75rem;
            }

            .chart-container {
                height: 250px;
            }

            .info-card,
            .action-card {
                flex-direction: column;
                text-align: center;
            }

            .info-content,
            .action-content {
                flex: 1;
            }
        }

        @media (max-width: 576px) {
            .dashboard-title {
                font-size: 1.75rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .stat-label {
                font-size: 0.8rem;
            }
        }

        /* News Dashboard Styles */
        .news-dashboard-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .news-dashboard-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            background: rgba(0, 0, 0, 0.01);
        }

        .news-dashboard-header h4 {
            margin: 0;
            font-size: 1.3rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .news-dashboard-header p {
            font-size: 0.9rem;
        }

        .news-dashboard-actions {
            display: flex;
            gap: 0.5rem;
        }

        .news-dashboard-body {
            padding: 1.5rem;
        }

        .news-dashboard-table {
            margin-bottom: 0;
        }

        .news-dashboard-table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            color: #495057;
            padding: 1rem;
        }

        .news-dashboard-table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .news-dashboard-table tbody tr {
            transition: all 0.2s ease;
        }

        .news-dashboard-table tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }

        .news-title-cell {
            max-width: 300px;
        }

        .news-title-cell strong {
            color: #1a1a1a;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .news-dashboard-header .d-flex {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .news-dashboard-actions {
                margin-top: 1rem;
                width: 100%;
            }

            .news-dashboard-actions .btn {
                flex: 1;
            }

            .news-title-cell {
                max-width: 150px;
            }
        }
    </style>
@endsection

@section('custom-footer')
    <script>
        var usersPerMonth = @json($usersPerMonth);
        var newsPerMonth = @json($newsPerMonth);
        var totalUsersCurrentMonth = @json($totalUsersCurrentMonth);
        var totalNewsCurrentMonth = @json($totalNewsCurrentMonth);
        var currentMonth = @json($currentMonth);
    </script>
    <script src="{{ asset('js/charts.js') }}"></script>
@endsection
