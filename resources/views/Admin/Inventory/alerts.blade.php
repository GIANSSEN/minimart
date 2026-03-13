@extends('layouts.admin')

@section('title', 'Inventory Alerts - CJ\'s Minimart')

@section('content')
<div class="container-fluid px-0"> <!-- FULL WIDTH -->
    <!-- Page Header -->
    <div class="row mx-0 mb-4">
        <div class="col-12 px-0">
            <div class="modern-header d-flex flex-wrap align-items-center justify-content-between gap-3 py-3 px-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="header-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-0" style="font-size: clamp(1.8rem, 4vw, 2.2rem);">Inventory Alerts</h1>
                        <p class="text-muted mb-0">Monitor stock levels, expired items, and other inventory issues</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.inventory.export-history', ['type' => 'alerts']) }}" class="btn btn-success">
                        <i class="fas fa-download me-2"></i>Export
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Stats Cards - SMALLER & BETTER ALIGNED -->
    <div class="row mx-0 g-3 mb-4">
        <div class="col-md-3 d-flex px-2">
            <div class="stat-card flex-fill w-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stat-details">
                        <span class="stat-label">Low Stock</span>
                        <span class="stat-value">{{ $stats['low_stock'] }}</span>
                        <span class="stat-trend">
                            <i class="fas fa-boxes me-1"></i>
                            Items below minimum
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 d-flex px-2">
            <div class="stat-card flex-fill w-100" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="stat-details">
                        <span class="stat-label">Out of Stock</span>
                        <span class="stat-value">{{ $stats['out_of_stock'] }}</span>
                        <span class="stat-trend">
                            <i class="fas fa-ban me-1"></i>
                            Unavailable items
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 d-flex px-2">
            <div class="stat-card flex-fill w-100" style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="fas fa-skull-crossbones"></i>
                    </div>
                    <div class="stat-details">
                        <span class="stat-label">Expired</span>
                        <span class="stat-value">{{ $stats['expired'] }}</span>
                        <span class="stat-trend">
                            <i class="fas fa-calendar-times me-1"></i>
                            Past expiry date
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 d-flex px-2">
            <div class="stat-card flex-fill w-100" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-details">
                        <span class="stat-label">Near Expiry</span>
                        <span class="stat-value">{{ $stats['near_expiry'] }}</span>
                        <span class="stat-trend">
                            <i class="fas fa-hourglass-half me-1"></i>
                            Expiring within 30 days
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Tabs - CENTERED -->
    <div class="row mx-0 mb-4">
        <div class="col-12 px-2"> <!-- Added padding to match stat boxes -->
            <div class="card border-0 shadow-sm">
                <div class="card-body py-2">
                    <ul class="nav nav-tabs border-0 justify-content-start" id="alertTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $type == 'all' || $type == 'low' ? 'active' : '' }}" 
                                    onclick="window.location.href='{{ route('admin.inventory.alerts', ['type' => 'low']) }}'">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Low Stock 
                                <span class="badge bg-warning ms-2">{{ $lowStock->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $type == 'out' ? 'active' : '' }}" 
                                    onclick="window.location.href='{{ route('admin.inventory.alerts', ['type' => 'out']) }}'">
                                <i class="fas fa-times-circle me-2"></i>
                                Out of Stock 
                                <span class="badge bg-danger ms-2">{{ $outOfStock->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $type == 'expired' ? 'active' : '' }}" 
                                    onclick="window.location.href='{{ route('admin.inventory.alerts', ['type' => 'expired']) }}'">
                                <i class="fas fa-skull-crossbones me-2"></i>
                                Expired 
                                <span class="badge bg-secondary ms-2">{{ $expiredProducts->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $type == 'near' ? 'active' : '' }}" 
                                    onclick="window.location.href='{{ route('admin.inventory.alerts', ['type' => 'near']) }}'">
                                <i class="fas fa-clock me-2"></i>
                                Near Expiry 
                                <span class="badge bg-warning ms-2">{{ $nearExpiry->count() }}</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Tab - FULL WIDTH ALIGNED -->
    @if($type == 'all' || $type == 'low')
    <div class="row mx-0 mb-4">
        <div class="col-12 px-2"> <!-- Added padding to match stat boxes -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2 px-3"> <!-- Reduced padding -->
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        Low Stock Items
                        <span class="badge bg-secondary ms-2">{{ $lowStock->count() }}</span>
                    </h5>
                    <div class="d-flex gap-2">
                        <select name="per_page_low" class="form-select form-select-sm" style="width: 130px;" onchange="window.location.href=this.value">
                            <option value="{{ request()->fullUrlWithQuery(['per_page_low' => 15]) }}" {{ request('per_page_low',15)==15?'selected':'' }}>15 per page</option>
                            <option value="{{ request()->fullUrlWithQuery(['per_page_low' => 25]) }}" {{ request('per_page_low')==25?'selected':'' }}>25 per page</option>
                            <option value="{{ request()->fullUrlWithQuery(['per_page_low' => 50]) }}" {{ request('per_page_low')==50?'selected':'' }}>50 per page</option>
                            <option value="{{ request()->fullUrlWithQuery(['per_page_low' => 100]) }}" {{ request('per_page_low')==100?'selected':'' }}>100 per page</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-3 py-3 text-start">Product</th> <!-- Reduced padding -->
                                    <th class="py-3 text-start">Code</th>
                                    <th class="py-3 text-center">Current</th>
                                    <th class="py-3 text-center">Minimum</th>
                                    <th class="py-3 text-start">Last Restocked</th>
                                    <th class="py-3 text-center">Status</th>
                                    <th class="text-end px-3 py-3">Action</th> <!-- Reduced padding -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lowStock as $item)
                                <tr>
                                    <td class="px-3 text-start"> <!-- Reduced padding -->
                                        <div class="d-flex align-items-center">
                                            @if($item->product && $item->product->image)
                                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->product_name }}" 
                                                     class="rounded-3 me-3" width="48" height="48" style="object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center" 
                                                     style="width: 48px; height: 48px;">
                                                    <i class="fas fa-box fa-2x text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ $item->product->product_name ?? 'N/A' }}</div>
                                                @if($item->product && $item->product->brand)
                                                    <small class="text-muted">{{ $item->product->brand }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                            {{ $item->product->product_code ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold text-warning">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="text-center">{{ $item->min_quantity }}</td>
                                    <td class="text-start">
                                        @php
                                            $lastTransaction = $item->product ? $item->product->stockTransactions()->where('type', 'in')->latest()->first() : null;
                                        @endphp
                                        @if($lastTransaction)
                                            <span title="{{ $lastTransaction->created_at->format('M d, Y h:i A') }}">
                                                {{ $lastTransaction->created_at->diffForHumans() }}
                                            </span>
                                        @else
                                            <span class="text-muted">Never</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                            <i class="fas fa-exclamation-triangle me-1"></i> Low Stock
                                        </span>
                                    </td>
                                    <td class="text-end px-3"> <!-- Reduced padding -->
                                        <button class="btn btn-sm btn-primary" onclick="showStockInModal({{ $item->product_id }}, '{{ $item->product->product_name }}')">
                                            <i class="fas fa-plus me-1"></i> Restock
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                                            <h5 class="text-muted">No Low Stock Items</h5>
                                            <p class="text-muted mb-0">All products are above minimum stock levels.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Out of Stock Tab - FULL WIDTH ALIGNED -->
    @if($type == 'all' || $type == 'out')
    <div class="row mx-0 mb-4">
        <div class="col-12 px-2"> <!-- Added padding to match stat boxes -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2 px-3"> <!-- Reduced padding -->
                    <h5 class="mb-0">
                        <i class="fas fa-times-circle text-danger me-2"></i>
                        Out of Stock Items
                        <span class="badge bg-secondary ms-2">{{ $outOfStock->count() }}</span>
                    </h5>
                    <div>
                        <button class="btn btn-sm btn-primary" onclick="bulkRestockOutOfStock()">
                            <i class="fas fa-plus me-1"></i> Restock All
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-3 py-3 text-start">Product</th> <!-- Reduced padding -->
                                    <th class="py-3 text-start">Code</th>
                                    <th class="py-3 text-center">Last Stock</th>
                                    <th class="py-3 text-start">Last Sold</th>
                                    <th class="py-3 text-center">Status</th>
                                    <th class="text-end px-3 py-3">Action</th> <!-- Reduced padding -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($outOfStock as $item)
                                <tr>
                                    <td class="px-3 text-start"> <!-- Reduced padding -->
                                        <div class="d-flex align-items-center">
                                            @if($item->product && $item->product->image)
                                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->product_name }}" 
                                                     class="rounded-3 me-3" width="48" height="48" style="object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center" 
                                                     style="width: 48px; height: 48px;">
                                                    <i class="fas fa-box fa-2x text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ $item->product->product_name ?? 'N/A' }}</div>
                                                @if($item->product && $item->product->brand)
                                                    <small class="text-muted">{{ $item->product->brand }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                            {{ $item->product->product_code ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold text-danger">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="text-start">
                                        @php
                                            $lastSale = $item->product ? $item->product->stockTransactions()->where('type', 'out')->where('reason', 'sale')->latest()->first() : null;
                                        @endphp
                                        @if($lastSale)
                                            <span title="{{ $lastSale->created_at->format('M d, Y h:i A') }}">
                                                {{ $lastSale->created_at->diffForHumans() }}
                                            </span>
                                        @else
                                            <span class="text-muted">Never</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                                            <i class="fas fa-times-circle me-1"></i> Out of Stock
                                        </span>
                                    </td>
                                    <td class="text-end px-3"> <!-- Reduced padding -->
                                        <button class="btn btn-sm btn-primary" onclick="showStockInModal({{ $item->product_id }}, '{{ $item->product->product_name }}')">
                                            <i class="fas fa-plus me-1"></i> Restock
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                                            <h5 class="text-muted">No Out of Stock Items</h5>
                                            <p class="text-muted mb-0">All products have stock available.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Expired Products Tab - FULL WIDTH ALIGNED -->
    @if($type == 'all' || $type == 'expired')
    <div class="row mx-0 mb-4">
        <div class="col-12 px-2"> <!-- Added padding to match stat boxes -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2 px-3"> <!-- Reduced padding -->
                    <h5 class="mb-0">
                        <i class="fas fa-skull-crossbones text-secondary me-2"></i>
                        Expired Products
                        <span class="badge bg-secondary ms-2">{{ $expiredProducts->count() }}</span>
                    </h5>
                    <div>
                        <button class="btn btn-sm btn-danger" onclick="bulkDispose()">
                            <i class="fas fa-trash me-1"></i> Bulk Dispose
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-3 py-3 text-start">Product</th> <!-- Reduced padding -->
                                    <th class="py-3 text-start">Code</th>
                                    <th class="py-3 text-start">Expiry Date</th>
                                    <th class="py-3 text-center">Days Expired</th>
                                    <th class="py-3 text-center">Stock</th>
                                    <th class="py-3 text-center">Status</th>
                                    <th class="text-end px-3 py-3">Action</th> <!-- Reduced padding -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($expiredProducts as $product)
                                <tr>
                                    <td class="px-3 text-start"> <!-- Reduced padding -->
                                        <div class="d-flex align-items-center">
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}" 
                                                     class="rounded-3 me-3" width="48" height="48" style="object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center" 
                                                     style="width: 48px; height: 48px;">
                                                    <i class="fas fa-box fa-2x text-muted"></i>
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
                                    <td class="text-start">{{ $product->product_code }}</td>
                                    <td class="text-start">
                                        <span class="text-danger fw-bold">{{ \Carbon\Carbon::parse($product->expiry_date)->format('M d, Y') }}</span>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $days = \Carbon\Carbon::parse($product->expiry_date)->diffInDays(now());
                                        @endphp
                                        <span class="badge bg-danger">{{ $days }} days</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold">{{ $product->stock->quantity ?? 0 }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                            <i class="fas fa-skull-crossbones me-1"></i> Expired
                                        </span>
                                    </td>
                                    <td class="text-end px-3"> <!-- Reduced padding -->
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button class="btn btn-sm btn-outline-danger" onclick="disposeProduct({{ $product->id }}, '{{ $product->product_name }}')">
                                                <i class="fas fa-trash me-1"></i> Dispose
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" onclick="extendExpiry({{ $product->id }})">
                                                <i class="fas fa-calendar-plus me-1"></i> Extend
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                                            <h5 class="text-muted">No Expired Products</h5>
                                            <p class="text-muted mb-0">All products are within expiry date.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Near Expiry Tab - FULL WIDTH ALIGNED (YOUR REFERENCE) -->
    @if($type == 'all' || $type == 'near')
    <div class="row mx-0 mb-4">
        <div class="col-12 px-2"> <!-- Added padding to match stat boxes -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2 px-3"> <!-- Reduced padding -->
                    <h5 class="mb-0">
                        <i class="fas fa-clock text-warning me-2"></i>
                        Near Expiry Products
                        <span class="badge bg-secondary ms-2">{{ $nearExpiry->count() }}</span>
                    </h5>
                    <div>
                        <button class="btn btn-sm btn-warning" onclick="bulkPromoteNearExpiry()">
                            <i class="fas fa-tag me-1"></i> Mark for Sale
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-3 py-3 text-start">PRODUCT</th> <!-- Reduced padding -->
                                    <th class="py-3 text-start">CODE</th>
                                    <th class="py-3 text-start">EXPIRY DATE</th>
                                    <th class="py-3 text-center">DAYS LEFT</th>
                                    <th class="py-3 text-center">STOCK</th>
                                    <th class="py-3 text-center">STATUS</th>
                                    <th class="text-end px-3 py-3">ACTION</th> <!-- Reduced padding -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($nearExpiry as $product)
                                <tr>
                                    <td class="px-3 text-start"> <!-- Reduced padding -->
                                        <div class="d-flex align-items-center">
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}" 
                                                     class="rounded-3 me-3" width="48" height="48" style="object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center" 
                                                     style="width: 48px; height: 48px;">
                                                    <i class="fas fa-box fa-2x text-muted"></i>
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
                                    <td class="text-start">{{ $product->product_code }}</td>
                                    <td class="text-start">
                                        <span class="text-warning fw-bold">{{ \Carbon\Carbon::parse($product->expiry_date)->format('M d, Y') }}</span>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $days = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($product->expiry_date), false);
                                            $days = max(0, $days);
                                        @endphp
                                        <span class="badge bg-warning">{{ $days }} days</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold">{{ $product->stock->quantity ?? 0 }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                            <i class="fas fa-clock me-1"></i> Near Expiry
                                        </span>
                                    </td>
                                    <td class="text-end px-3"> <!-- Reduced padding -->
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button class="btn btn-sm btn-outline-warning" onclick="promoteProduct({{ $product->id }})">
                                                <i class="fas fa-tag me-1"></i> Promote
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" onclick="disposeProduct({{ $product->id }}, '{{ $product->product_name }}')">
                                                <i class="fas fa-trash me-1"></i> Dispose
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                                            <h5 class="fw-semibold">No Near Expiry Products</h5>
                                            <p class="text-muted mb-0">All products have sufficient shelf life.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Stock In Modal -->
<div class="modal fade" id="stockInModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-arrow-down me-2"></i>Add Stock</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="stockInForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="stock_product_id">
                    <input type="hidden" name="type" value="in">
                    <input type="hidden" name="reason" value="restock">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Product</label>
                        <input type="text" class="form-control bg-light" id="stock_product_name" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" class="form-control" step="0.01" min="0.01" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Unit Cost</label>
                        <input type="number" name="unit_cost" class="form-control" step="0.01" min="0">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Reference</label>
                        <input type="text" name="reference" class="form-control" placeholder="PO-12345">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Notes</label>
                        <textarea name="notes" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Extend Expiry Modal -->
<div class="modal fade" id="extendExpiryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title"><i class="fas fa-calendar-plus me-2"></i>Extend Expiry Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="extendExpiryForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="extend_product_id">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Product</label>
                        <input type="text" class="form-control bg-light" id="extend_product_name" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Current Expiry Date</label>
                        <input type="text" class="form-control bg-light" id="current_expiry_date" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">New Expiry Date <span class="text-danger">*</span></label>
                        <input type="date" name="new_expiry_date" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Reason</label>
                        <textarea name="reason" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Extend Expiry</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* FULL WIDTH FIXES */
    .container-fluid.px-0 {
        width: 100%;
        max-width: 100%;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    
    .row.mx-0 {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }
    
    /* Consistent padding for all columns */
    [class*="col-"].px-2 {
        padding-left: 0.5rem !important;
        padding-right: 0.5rem !important;
    }

    /* MODERN HEADER */
    .modern-header {
        background: white;
        border-bottom: 2px solid #dc3545;
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .modern-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: min(300px, 30vw);
        height: min(300px, 30vw);
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        opacity: 0.03;
        border-radius: 50%;
        transform: rotate(25deg);
    }

    .header-icon {
        width: clamp(55px, 6vw, 65px);
        height: clamp(55px, 6vw, 65px);
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: clamp(1.8rem, 4vw, 2.2rem);
        box-shadow: 0 10px 20px rgba(220, 53, 69, 0.3);
        flex-shrink: 0;
        z-index: 2;
    }

    /* STAT CARDS - SMALLER AND BETTER ALIGNED */
    .stat-card {
        border-radius: 16px;
        padding: 1.25rem 1rem;
        color: white;
        position: relative;
        overflow: hidden;
        min-height: 100px;
        width: 100%;
        transition: all 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    .stat-card .stat-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        z-index: 2;
        height: 100%;
    }

    .stat-card .stat-icon {
        width: 45px;
        height: 45px;
        background: rgba(255,255,255,0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        backdrop-filter: blur(5px);
        flex-shrink: 0;
    }

    .stat-card .stat-details {
        flex: 1;
    }

    .stat-card .stat-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.9;
        display: block;
        margin-bottom: 2px;
    }

    .stat-card .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 1;
        display: block;
        margin-bottom: 2px;
    }

    .stat-card .stat-trend {
        font-size: 0.7rem;
        opacity: 0.9;
        display: flex;
        align-items: center;
        gap: 3px;
        white-space: nowrap;
    }

    /* TABS */
    .nav-tabs {
        border-bottom: 2px solid #e9ecef;
        gap: 0.5rem;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 8px 8px 0 0;
        transition: all 0.2s;
    }

    .nav-tabs .nav-link:hover {
        background: #f8f9fa;
        color: #dc3545;
    }

    .nav-tabs .nav-link.active {
        background: transparent;
        color: #dc3545;
        border-bottom: 2px solid #dc3545;
    }

    /* TABLE STYLES - ALIGNMENT FIXED */
    .card {
        border-radius: 16px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05) !important;
    }

    .table {
        width: 100%;
        margin-bottom: 0;
    }

    .table thead th {
        background: #f8f9fa;
        color: #495056;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #e9ecef;
        white-space: nowrap;
    }

    .table tbody td {
        vertical-align: middle;
        padding: 1rem 1rem;
        border-bottom: 1px solid #f1f3f5;
        font-size: 0.95rem;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* TEXT ALIGNMENT CLASSES */
    .text-start {
        text-align: left !important;
    }
    
    .text-center {
        text-align: center !important;
    }
    
    .text-end {
        text-align: right !important;
    }

    /* BADGES */
    .badge {
        font-weight: 500;
        padding: 0.6rem 1.2rem;
        border-radius: 30px;
        font-size: 0.85rem;
    }

    /* EMPTY STATE */
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .modern-header {
            padding: 15px !important;
        }
        
        .header-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }

        .stat-card {
            min-height: 90px;
            padding: 1rem;
        }

        .stat-card .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 1.3rem;
            border-radius: 10px;
        }
        
        .stat-card .stat-value {
            font-size: 1.5rem;
        }
        
        .stat-card .stat-label {
            font-size: 0.75rem;
        }
        
        .stat-card .stat-trend {
            font-size: 0.65rem;
        }

        .table thead {
            display: none;
        }

        .table tbody tr {
            display: block;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 15px;
        }

        .table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: none;
            padding: 8px 10px;
        }

        .table tbody td:before {
            content: attr(data-label);
            font-weight: 600;
            color: #495057;
            margin-right: 10px;
            width: 40%;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showStockInModal(id, name) {
        document.getElementById('stock_product_id').value = id;
        document.getElementById('stock_product_name').value = name;
        new bootstrap.Modal(document.getElementById('stockInModal')).show();
    }

    function disposeProduct(id, name) {
        Swal.fire({
            title: 'Dispose Product?',
            text: `Remove ${name} from inventory?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Yes, dispose'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Disposed!', 'Product has been removed.', 'success');
            }
        });
    }

    function promoteProduct(id) {
        Swal.fire({
            title: 'Mark for Sale',
            text: 'Product marked for sale due to near expiry.',
            icon: 'success',
            timer: 1500
        });
    }

    function extendExpiry(id) {
        fetch(`/admin/inventory/product/${id}/stock`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('extend_product_id').value = id;
                document.getElementById('extend_product_name').value = data.product_name;
                document.getElementById('current_expiry_date').value = data.expiry_date || 'No expiry set';
                new bootstrap.Modal(document.getElementById('extendExpiryModal')).show();
            });
    }

    function bulkRestockOutOfStock() {
        Swal.fire({
            title: 'Restock All',
            text: 'Restock all out of stock items?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Success!', 'All items restocked.', 'success');
            }
        });
    }

    function bulkDispose() {
        Swal.fire({
            title: 'Bulk Dispose',
            text: 'Dispose all expired items?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Yes, dispose'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Disposed!', 'Expired items disposed.', 'success');
            }
        });
    }

    function bulkPromoteNearExpiry() {
        Swal.fire({
            title: 'Mark for Sale',
            text: 'All near expiry items marked for sale.',
            icon: 'success',
            timer: 1500
        });
    }

    document.getElementById('stockInForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        Swal.fire({
            title: 'Processing...',
            text: 'Please wait',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        
        fetch('{{ route("admin.inventory.process-stock-in") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire('Error!', data.message || 'Something went wrong.', 'error');
            }
        })
        .catch(error => {
            Swal.fire('Error!', 'Network error occurred.', 'error');
        });
    });

    document.getElementById('extendExpiryForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        Swal.fire({
            title: 'Processing...',
            text: 'Please wait',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        
        fetch('/admin/products/extend-expiry', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire('Error!', data.message || 'Something went wrong.', 'error');
            }
        })
        .catch(error => {
            Swal.fire('Error!', 'Network error occurred.', 'error');
        });
    });

    // Add data-label attributes for mobile
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.table').forEach(table => {
            const headers = [];
            table.querySelectorAll('thead th').forEach(th => {
                headers.push(th.textContent.trim());
            });
            
            table.querySelectorAll('tbody tr').forEach(row => {
                row.querySelectorAll('td').forEach((td, index) => {
                    if (headers[index]) {
                        td.setAttribute('data-label', headers[index]);
                    }
                });
            });
        });
    });
</script>
@endpush