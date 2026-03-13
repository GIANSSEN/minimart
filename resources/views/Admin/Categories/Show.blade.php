@extends('layouts.admin')

@section('title', 'Category Details - ' . $category->category_name . ' - CJ\'s Minimart')

@section('content')
<div class="container-fluid px-3 px-md-4">
    <!-- Breadcrumb -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active">{{ $category->category_name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Page Header -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                <i class="fas fa-folder text-primary fa-2x"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold">{{ $category->category_name }}</h4>
                                <p class="text-muted mb-0">
                                    Created {{ $category->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>Edit Category
                            </a>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Details & Products -->
    <div class="row g-3 g-md-4">
        <!-- Left Column - Category Details -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Category Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-4 d-inline-block mb-3">
                            <i class="fas fa-folder-open text-primary fa-4x"></i>
                        </div>
                        <h4 class="fw-bold">{{ $category->category_name }}</h4>
                        @if($category->parent_id)
                            <p class="text-muted mb-0">
                                <i class="fas fa-level-up-alt me-1"></i>
                                Parent Category: <a href="{{ route('admin.categories.show', $category->parent_id) }}" class="text-decoration-none">
                                    {{ $category->parent->category_name ?? 'N/A' }}
                                </a>
                            </p>
                        @endif
                    </div>

                    <table class="table table-borderless">
                        <tr>
                            <td width="40%" class="text-muted">ID:</td>
                            <td class="fw-semibold">#{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Category Code:</td>
                            <td>
                                @if($category->category_code)
                                    <code>{{ $category->category_code }}</code>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td class="text-muted">Products Count:</td>
                            <td>
                                <span class="badge bg-info">{{ $category->products_count ?? $category->products->count() }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Created By:</td>
                            <td>
                                @if($category->creator)
                                    {{ $category->creator->name ?? $category->creator->username }}
                                @else
                                    <span class="text-muted">System</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Created At:</td>
                            <td>{{ $category->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Last Updated:</td>
                            <td>{{ $category->updated_at->diffForHumans() }}</td>
                        </tr>
                    </table>

                    @if($category->description)
                        <div class="mt-3">
                            <h6 class="fw-semibold mb-2">Description:</h6>
                            <p class="text-muted bg-light p-3 rounded">{{ $category->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Products in this Category -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-box text-primary me-2"></i>
                        Products in this Category
                        <span class="badge bg-secondary ms-2">{{ $category->products->count() }} items</span>
                    </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.products.index', ['category' => $category->id]) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-external-link-alt me-1"></i>View All
                        </a>
                        <a href="{{ route('admin.products.create', ['category' => $category->id]) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus-circle me-1"></i>Add Product
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($category->products->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-3 py-3">Product</th>
                                        <th class="py-3">Code</th>
                                        <th class="py-3">Price</th>
                                        <th class="py-3">Stock</th>
                                        <th class="py-3">Status</th>
                                        <th class="text-end px-3 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->products as $product)
                                    <tr>
                                        <td class="px-3">
                                            <div class="d-flex align-items-center">
                                                @if($product->image)
                                                    <img src="{{ asset($product->image) }}" 
                                                         alt="{{ $product->product_name }}"
                                                         class="rounded me-2"
                                                         style="width: 35px; height: 35px; object-fit: cover;">
                                                @else
                                                    <div class="rounded bg-secondary bg-opacity-10 p-2 me-2">
                                                        <i class="fas fa-box text-secondary"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-semibold">{{ $product->product_name }}</div>
                                                    @if($product->brand)
                                                        <small class="text-muted">{{ $product->brand }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <code>{{ $product->product_code }}</code>
                                            @if($product->barcode)
                                                <br>
                                                <small class="text-muted">{{ $product->barcode }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-semibold">₱{{ number_format($product->selling_price, 2) }}</span>
                                            @if($product->cost_price > 0)
                                                <br>
                                                <small class="text-muted">Cost: ₱{{ number_format($product->cost_price, 2) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $stock = $product->stock->quantity ?? 0;
                                                $reorderLevel = $product->reorder_level ?? 5;
                                            @endphp
                                            @if($stock <= 0)
                                                <span class="badge bg-danger">Out of Stock</span>
                                            @elseif($stock <= $reorderLevel)
                                                <span class="badge bg-warning text-dark">{{ $stock }} left</span>
                                            @else
                                                <span class="badge bg-success">{{ $stock }} in stock</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($product->status == 'discontinued')
                                                <span class="badge bg-danger">Discontinued</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-end px-3">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('admin.products.show', $product->id) }}">
                                                            <i class="fas fa-eye text-info me-2"></i>View
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('admin.products.edit', $product->id) }}">
                                                            <i class="fas fa-edit text-primary me-2"></i>Edit
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-box-open fa-4x mb-3"></i>
                                <h5>No Products in this Category</h5>
                                <p class="mb-3">This category doesn't have any products yet.</p>
                                <a href="{{ route('admin.products.create', ['category' => $category->id]) }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-2"></i>Add First Product
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Additional Stats Cards -->
            <div class="row g-3 mt-3">
                <div class="col-6 col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-muted small mb-1">Total Products</div>
                            <h3 class="fw-bold mb-0">{{ $category->products->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-muted small mb-1">Low Stock Products</div>
                            <h3 class="fw-bold mb-0 text-warning">
                                {{ $category->products->filter(function($product) { 
                                    $stock = $product->stock->quantity ?? 0;
                                    return $stock > 0 && $stock <= ($product->reorder_level ?? 5);
                                })->count() }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-muted small mb-1">Total Value</div>
                            <h3 class="fw-bold mb-0 text-primary">
                                ₱{{ number_format($category->products->sum(function($product) {
                                    return ($product->stock->quantity ?? 0) * $product->selling_price;
                                }), 0) }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table td {
        font-size: 0.9rem;
    }
    
    .bg-primary.bg-opacity-10 {
        transition: transform 0.2s;
    }
    
    .bg-primary.bg-opacity-10:hover {
        transform: scale(1.05);
    }
    
    @media (max-width: 768px) {
        .table td, .table th {
            font-size: 0.85rem;
        }
        
        h4 {
            font-size: 1.2rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Confirm delete if needed
    function confirmDelete(url) {
        if (confirm('Are you sure you want to delete this product?')) {
            window.location.href = url;
        }
    }
</script>
@endpush
@endsection