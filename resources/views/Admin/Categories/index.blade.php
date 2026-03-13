@extends('layouts.admin')

@section('title', 'Categories - CJ\'s Minimart')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="modern-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="header-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div>
                            <h1 class="display-6 fw-bold mb-1">Categories</h1>
                            <p class="text-muted mb-0">
                                <i class="fas fa-folder-tree me-2"></i>
                                Organize your products with categories
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Add New Category
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="row g-4">
        @forelse($categories as $category)
        <div class="col-xl-4 col-lg-6">
            <div class="category-card">
                <div class="category-card-header">
                    <div class="category-icon" style="background: {{ $category->color ?? '#667eea' }}15; color: {{ $category->color ?? '#667eea' }}">
                        <i class="fas fa-folder"></i>
                    </div>
                    <div class="category-info">
                        <h5 class="category-name">{{ $category->category_name }}</h5>
                        <span class="category-meta">
                            <i class="fas fa-hashtag"></i> ID: {{ $category->id }}
                        </span>
                    </div>

                </div>
                
                <div class="category-card-body">
                    @if($category->description)
                        <p class="category-description">{{ Str::limit($category->description, 100) }}</p>
                    @else
                        <p class="category-description text-muted fst-italic">No description provided</p>
                    @endif
                    
                    <div class="category-stats">
                        <div class="stat-item">
                            <span class="stat-value">{{ $category->products_count }}</span>
                            <span class="stat-label">Products</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">{{ $category->created_at->format('M d, Y') }}</span>
                            <span class="stat-label">Created</span>
                        </div>
                    </div>
                </div>
                
                <div class="category-card-footer">
                    <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-sm btn-outline-info" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-danger" 
                            onclick="deleteCategory({{ $category->id }}, '{{ addslashes($category->category_name) }}')"
                            title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <h3>No Categories Found</h3>
                <p class="text-muted">Get started by creating your first category</p>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus-circle me-2"></i>Create Category
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($categories->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} categories
        </div>
        <div>
            {{ $categories->links() }}
        </div>
    </div>
    @endif
</div>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>
@endsection

@push('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --info-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .modern-header {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }

    .modern-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: var(--primary-gradient);
        opacity: 0.03;
        border-radius: 50%;
        transform: rotate(25deg);
    }

    .header-icon {
        width: 70px;
        height: 70px;
        background: var(--primary-gradient);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    /* Category Cards */
    .category-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
        overflow: hidden;
        transition: all 0.3s;
        height: 100%;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.15);
    }

    .category-card-header {
        padding: 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        display: flex;
        align-items: center;
        gap: 15px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .category-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: all 0.3s;
    }

    .category-card:hover .category-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .category-info {
        flex: 1;
    }

    .category-name {
        font-weight: 600;
        margin: 0 0 4px;
        color: #1e1e2d;
    }

    .category-meta {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .category-meta i {
        font-size: 0.7rem;
    }



    .category-card-body {
        padding: 20px;
    }

    .category-description {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 20px;
        min-height: 60px;
    }

    .category-stats {
        display: flex;
        gap: 20px;
        padding-top: 15px;
        border-top: 1px solid #e9ecef;
    }

    .stat-item {
        flex: 1;
        text-align: center;
    }

    .stat-item .stat-value {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1e1e2d;
        display: block;
        margin-bottom: 4px;
    }

    .stat-item .stat-label {
        font-size: 0.75rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .category-card-footer {
        padding: 15px 20px;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .category-card-footer .btn {
        padding: 0.5rem 1rem;
        border-radius: 10px;
        transition: all 0.3s;
    }

    .category-card-footer .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .btn-outline-info {
        border-color: #dee2e6;
        color: #17a2b8;
    }

    .btn-outline-info:hover {
        background: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }

    .btn-outline-primary {
        border-color: #dee2e6;
        color: #667eea;
    }

    .btn-outline-primary:hover {
        background: #667eea;
        border-color: #667eea;
        color: white;
    }

    .btn-outline-success {
        border-color: #dee2e6;
        color: #10b981;
    }

    .btn-outline-success:hover {
        background: #10b981;
        border-color: #10b981;
        color: white;
    }

    .btn-outline-danger {
        border-color: #dee2e6;
        color: #ef4444;
    }

    .btn-outline-danger:hover {
        background: #ef4444;
        border-color: #ef4444;
        color: white;
    }

    /* Badge Styles */
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
    }

    .badge.bg-success {
        background: linear-gradient(135deg, #10b981, #059669) !important;
    }

    .badge.bg-secondary {
        background: linear-gradient(135deg, #6c757d, #495057) !important;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .empty-state-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        color: white;
        font-size: 3rem;
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
    }

    .empty-state h3 {
        font-size: 1.8rem;
        font-weight: 600;
        color: #1e1e2d;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #6c757d;
        margin-bottom: 30px;
        font-size: 1.1rem;
    }

    /* Toast Container */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    .toast {
        min-width: 300px;
        padding: 16px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
        animation: slideInRight 0.3s ease;
        border-left: 4px solid;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .toast.success { border-left-color: #10b981; }
    .toast.error { border-left-color: #ef4444; }
    .toast.warning { border-left-color: #f59e0b; }
    .toast.info { border-left-color: #3b82f6; }

    .toast-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .toast.success .toast-icon {
        background: #d1fae5;
        color: #10b981;
    }

    .toast-content {
        flex: 1;
    }

    .toast-title {
        font-weight: 600;
        margin-bottom: 2px;
        color: #1e1e2d;
    }

    .toast-message {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .toast-close {
        background: none;
        border: none;
        color: #adb5bd;
        cursor: pointer;
        padding: 4px;
    }

    /* Pagination */
    .pagination {
        gap: 5px;
    }

    .page-link {
        border: none;
        border-radius: 10px;
        padding: 0.5rem 1rem;
        color: #6c757d;
        transition: all 0.3s;
    }

    .page-link:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .page-item.active .page-link {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .modern-header {
            padding: 20px;
        }

        .header-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }

        .category-card-header {
            flex-wrap: wrap;
        }

        .category-status {
            margin-left: 0;
            width: 100%;
        }

        .category-card-footer {
            flex-wrap: wrap;
        }

        .category-card-footer .btn {
            flex: 1;
        }

        .empty-state {
            padding: 40px 20px;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteCategory(id, name) {
        Swal.fire({
            title: 'Delete Category?',
            html: `Are you sure you want to delete <strong>${name}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/categories/${id}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }



    function showToast(message, type = 'success') {
        const toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) return;

        const titles = {
            success: 'Success',
            error: 'Error',
            warning: 'Warning',
            info: 'Info'
        };

        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <div class="toast-icon ${type}">
                <i class="fas ${type === 'success' ? 'fa-check' : type === 'error' ? 'fa-times' : type === 'warning' ? 'fa-exclamation' : 'fa-info'}"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">${titles[type]}</div>
                <div class="toast-message">${message}</div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        `;

        toastContainer.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 5000);
    }
</script>
@endpush