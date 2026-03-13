@extends('layouts.admin')

@section('title', 'Stock In - CJ\'s Minimart')

@section('content')
<div class="container-fluid px-0">
    <!-- Page Header Enhanced (same as activity logs) -->
    <div class="row mx-0 mb-4">
        <div class="col-12 px-0">
            <div class="modern-header-enhanced d-flex flex-wrap align-items-center justify-content-between gap-3 py-3 px-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="header-icon-enhanced">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-0" style="font-size: clamp(1.5rem, 4vw, 1.8rem);">Stock In</h1>
                        <p class="text-muted mb-0 mt-2">Record incoming inventory and purchase receipts</p>
                    </div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newStockInModal" aria-label="New stock in">
                        <i class="fas fa-plus-circle me-2"></i><span class="d-none d-sm-inline">New Stock In</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Enhanced (4‑column, exactly like activity logs) -->
    <div class="row mx-0 g-2 g-md-3 mb-4 px-3 px-md-4" id="statsContainer" role="region" aria-label="Stock in statistics">
        <!-- Total Transactions -->
        <div class="col-6 col-md-3">
            <div class="stat-card-modern p-3 h-100 d-flex flex-column" role="region" aria-label="Total transactions">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon bg-primary" title="Total transactions">
                        <i class="fas fa-cubes"></i>
                    </div>
                    <div class="min-width-0">
                        <span class="stat-label text-uppercase text-muted small d-block text-truncate">Total</span>
                        <span class="stat-value fw-bold h3 text-truncate d-block" aria-label="Total transactions: {{ number_format($transactions->total()) }}">{{ number_format($transactions->total()) }}</span>
                    </div>
                </div>
                <div class="mt-auto small text-muted text-truncate">
                    <i class="fas fa-database me-1"></i><span>{{ $transactions->count() }} this page</span>
                </div>
            </div>
        </div>

        <!-- Total Quantity -->
        <div class="col-6 col-md-3">
            <div class="stat-card-modern p-3 h-100 d-flex flex-column" role="region" aria-label="Total quantity">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon bg-success" title="Total quantity">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div class="min-width-0">
                        <span class="stat-label text-uppercase text-muted small d-block text-truncate">Quantity</span>
                        <span class="stat-value fw-bold h3 text-truncate d-block" aria-label="Total quantity: {{ number_format($transactions->sum('quantity')) }}">{{ number_format($transactions->sum('quantity')) }}</span>
                    </div>
                </div>
                <div class="mt-auto small text-muted text-truncate">
                    <i class="fas fa-cubes me-1"></i><span>units received</span>
                </div>
            </div>
        </div>

        <!-- Total Cost -->
        <div class="col-6 col-md-3">
            <div class="stat-card-modern p-3 h-100 d-flex flex-column" role="region" aria-label="Total cost">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon bg-warning" title="Total cost">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="min-width-0">
                        <span class="stat-label text-uppercase text-muted small d-block text-truncate">Total Cost</span>
                        <span class="stat-value fw-bold h3 text-truncate d-block" aria-label="Total cost: ₱{{ number_format($transactions->sum('total_cost') ?? 0, 2) }}">₱{{ number_format($transactions->sum('total_cost') ?? 0, 2) }}</span>
                    </div>
                </div>
                <div class="mt-auto small text-muted text-truncate">
                    <i class="fas fa-chart-line me-1"></i><span>inventory value</span>
                </div>
            </div>
        </div>

        <!-- This Month -->
        <div class="col-6 col-md-3">
            <div class="stat-card-modern p-3 h-100 d-flex flex-column" role="region" aria-label="This month's transactions">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon bg-info" title="This month">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="min-width-0">
                        <span class="stat-label text-uppercase text-muted small d-block text-truncate">This Month</span>
                        <span class="stat-value fw-bold h3 text-truncate d-block" aria-label="This month: {{ number_format($monthlyCount ?? 0) }}">{{ number_format($monthlyCount ?? 0) }}</span>
                    </div>
                </div>
                <div class="mt-auto small text-muted text-truncate">
                    <i class="fas fa-calendar me-1"></i><span>{{ now()->format('F Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- The rest of your page (filter, table, modals) remains exactly as you had it -->
    <!-- ... (copy all the code from your original stock-in blade from the "Filters - Perfectly Aligned" section onward) ... -->
    
    <!-- Filters - Perfectly Aligned -->
    <div class="row mx-0 mb-4 px-3 px-md-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 p-md-4">
                    <!-- Filter Header with Export/Reset -->
                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 mb-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-filter text-primary me-2"></i>
                            Filter Stock In
                        </h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.inventory.export-history', ['type' => 'in']) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-download me-1"></i>Export
                            </a>
                            <a href="{{ route('admin.inventory.stock-in') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-redo-alt me-1"></i>Reset
                            </a>
                        </div>
                    </div>

                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('admin.inventory.stock-in') }}" id="filterForm">
                        <div class="row g-2">
                            <!-- Search -->
                            <div class="col-12 col-md-4">
                                <label class="form-label small text-muted mb-1">Search Product</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-search text-primary"></i>
                                    </span>
                                    <input type="text" 
                                           name="search" 
                                           class="form-control" 
                                           placeholder="Search product..." 
                                           value="{{ request('search') }}">
                                </div>
                            </div>
                            
                            <!-- Date From -->
                            <div class="col-6 col-md-2">
                                <label class="form-label small text-muted mb-1">From</label>
                                <input type="date" 
                                       name="date_from" 
                                       class="form-control" 
                                       value="{{ request('date_from') }}"
                                       placeholder="mm/dd/yyyy">
                            </div>
                            
                            <!-- Date To -->
                            <div class="col-6 col-md-2">
                                <label class="form-label small text-muted mb-1">To</label>
                                <input type="date" 
                                       name="date_to" 
                                       class="form-control" 
                                       value="{{ request('date_to') }}"
                                       placeholder="mm/dd/yyyy">
                            </div>
                            
                            <!-- Apply Button -->
                            <div class="col-12 col-md-4">
                                <label class="form-label small text-muted mb-1 d-none d-md-block">&nbsp;</label>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter me-2"></i>Apply Filters
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="row mx-0 px-3 px-md-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 px-3 px-md-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-list-alt text-primary me-2"></i>
                        Stock In Records
                        <span class="badge bg-secondary ms-2">{{ $transactions->total() }}</span>
                    </h5>
                    <select name="per_page" class="form-select form-select-sm w-auto" onchange="window.location.href=this.value">
                        <option value="{{ request()->fullUrlWithQuery(['per_page' => 15]) }}" {{ request('per_page',15)==15?'selected':'' }}>15 per page</option>
                        <option value="{{ request()->fullUrlWithQuery(['per_page' => 25]) }}" {{ request('per_page')==25?'selected':'' }}>25 per page</option>
                        <option value="{{ request()->fullUrlWithQuery(['per_page' => 50]) }}" {{ request('per_page')==50?'selected':'' }}>50 per page</option>
                        <option value="{{ request()->fullUrlWithQuery(['per_page' => 100]) }}" {{ request('per_page')==100?'selected':'' }}>100 per page</option>
                    </select>
                </div>
                <div class="card-body p-0">
                    <!-- Desktop Table View -->
                    <div class="table-responsive d-none d-md-block">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">DATE & TIME</th>
                                    <th class="py-3">PRODUCT</th>
                                    <th class="py-3 text-center">QUANTITY</th>
                                    <th class="py-3 text-end">UNIT COST</th>
                                    <th class="py-3 text-end">TOTAL COST</th>
                                    <th class="py-3">REFERENCE</th>
                                    <th class="py-3">USER</th>
                                    <th class="text-end px-4 py-3">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                <tr>
                                    <td class="px-4">
                                        <div class="fw-semibold">{{ $transaction->created_at ? $transaction->created_at->format('M d, Y') : 'N/A' }}</div>
                                        <small class="text-muted">{{ $transaction->created_at ? $transaction->created_at->format('h:i A') : '' }}</small>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="product-icon me-2">
                                                <div class="bg-primary bg-opacity-10 rounded-2 p-2">
                                                    <i class="fas fa-box text-primary"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ Str::limit($transaction->product->product_name ?? 'Deleted Product', 30) }}</div>
                                                <small class="text-muted">{{ $transaction->product->product_code ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success px-3 py-2">
                                            +{{ number_format($transaction->quantity) }}
                                        </span>
                                    </td>
                                    <td class="text-end fw-medium">
                                        ₱{{ number_format($transaction->unit_cost ?? 0, 2) }}
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-primary">
                                            ₱{{ number_format(($transaction->quantity * ($transaction->unit_cost ?? 0)), 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($transaction->reference)
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                                {{ $transaction->reference }}
                                            </span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar-xs me-2">
                                                <span class="avatar-initials rounded-circle bg-info bg-opacity-10 text-info">
                                                    {{ $transaction->user ? substr($transaction->user->name ?? 'S', 0, 1) : 'S' }}
                                                </span>
                                            </div>
                                            <span class="small">{{ $transaction->user->name ?? 'System' }}</span>
                                        </div>
                                    </td>
                                    <td class="text-end px-4">
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-outline-info" onclick="viewDetails({{ $transaction->id }})" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @if($transaction->created_at->diffInHours(now()) < 24)
                                            <button class="btn btn-sm btn-outline-danger" onclick="voidTransaction({{ $transaction->id }}, '{{ $transaction->product->product_name ?? '' }}', {{ $transaction->quantity }})" title="Void Transaction">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-arrow-down fa-4x text-muted mb-3"></i>
                                            <h5 class="text-muted">No Stock In Records</h5>
                                            <p class="text-muted mb-3">Start recording incoming inventory</p>
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newStockInModal">
                                                <i class="fas fa-plus-circle me-2"></i>New Stock In
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="d-block d-md-none p-3">
                        @forelse($transactions as $transaction)
                        <div class="mobile-card mb-3">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="product-icon">
                                        <div class="bg-primary bg-opacity-10 rounded-2 p-2">
                                            <i class="fas fa-box text-primary"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ Str::limit($transaction->product->product_name ?? 'Deleted Product', 20) }}</div>
                                        <small class="text-muted">{{ $transaction->product->product_code ?? '' }}</small>
                                    </div>
                                </div>
                                <span class="badge bg-success">+{{ number_format($transaction->quantity) }}</span>
                            </div>
                            
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Date</span>
                                    <span class="info-value">{{ $transaction->created_at ? $transaction->created_at->format('M d, Y') : 'N/A' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Time</span>
                                    <span class="info-value">{{ $transaction->created_at ? $transaction->created_at->format('h:i A') : '' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Unit Cost</span>
                                    <span class="info-value">₱{{ number_format($transaction->unit_cost ?? 0, 2) }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Total Cost</span>
                                    <span class="info-value text-primary fw-bold">₱{{ number_format(($transaction->quantity * ($transaction->unit_cost ?? 0)), 2) }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Reference</span>
                                    <span class="info-value">{{ $transaction->reference ?? '—' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">User</span>
                                    <span class="info-value">{{ $transaction->user->name ?? 'System' }}</span>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end gap-2 mt-3 pt-2 border-top">
                                <button class="btn btn-sm btn-outline-info" onclick="viewDetails({{ $transaction->id }})">
                                    <i class="fas fa-eye me-1"></i>View
                                </button>
                                @if($transaction->created_at->diffInHours(now()) < 24)
                                <button class="btn btn-sm btn-outline-danger" onclick="voidTransaction({{ $transaction->id }}, '{{ $transaction->product->product_name ?? '' }}', {{ $transaction->quantity }})">
                                    <i class="fas fa-ban me-1"></i>Void
                                </button>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5">
                            <i class="fas fa-arrow-down fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No Stock In Records</h5>
                            <p class="text-muted mb-3">Start recording incoming inventory</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newStockInModal">
                                <i class="fas fa-plus-circle me-2"></i>New Stock In
                            </button>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($transactions->hasPages())
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 px-3 px-md-4 py-3 border-top">
                        <div class="text-muted small text-center text-md-start">
                            Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries
                        </div>
                        <div class="pagination-responsive">
                            {{ $transactions->withQueryString()->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Stock In Modal -->
<div class="modal fade" id="newStockInModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-arrow-down me-2"></i>New Stock In
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="stockInForm" method="POST" action="{{ route('admin.inventory.process-stock-in') }}">
                @csrf
                <input type="hidden" name="type" value="in">
                
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Product Selection -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                Product <span class="text-danger">*</span>
                            </label>
                            <select name="product_id" class="form-select select2" id="productSelect" required>
                                <option value="">-- Select Product --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" 
                                            data-stock="{{ $product->stock->quantity ?? 0 }}"
                                            data-price="{{ $product->cost_price ?? 0 }}">
                                        {{ $product->product_name }} ({{ $product->product_code }}) 
                                        - Current Stock: {{ $product->stock->quantity ?? 0 }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="productError"></div>
                        </div>
                        
                        <!-- Quantity -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Quantity <span class="text-danger">*</span>
                            </label>
                            <input type="number" 
                                   name="quantity" 
                                   class="form-control" 
                                   step="0.01" 
                                   min="0.01" 
                                   id="quantity" 
                                   required>
                            <div class="invalid-feedback" id="quantityError"></div>
                        </div>
                        
                        <!-- Unit Cost -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Unit Cost
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number" 
                                       name="unit_cost" 
                                       class="form-control" 
                                       step="0.01" 
                                       min="0" 
                                       id="unitCost" 
                                       value="0.00">
                            </div>
                            <div class="invalid-feedback" id="unitCostError"></div>
                        </div>
                        
                        <!-- Reference -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Reference
                            </label>
                            <input type="text" 
                                   name="reference" 
                                   class="form-control" 
                                   placeholder="PO-12345, Invoice #">
                        </div>
                        
                        <!-- Expiry Date -->
                        <div class="col-md-6" id="expiryField" style="display: none;">
                            <label class="form-label fw-semibold">
                                Expiry Date
                            </label>
                            <input type="date" name="expiry_date" class="form-control" id="expiryDate">
                        </div>

                        <!-- Current Stock Display -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Current Stock</label>
                            <div class="form-control bg-light" id="currentStockDisplay" readonly>0</div>
                        </div>

                        <!-- Total Cost Display -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Total Cost</label>
                            <div class="form-control bg-light fw-bold text-primary" id="totalCostDisplay" readonly>₱0.00</div>
                        </div>
                        
                        <!-- Notes -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                Notes
                            </label>
                            <textarea name="notes" class="form-control" rows="2" placeholder="Additional notes..."></textarea>
                        </div>
                        
                        <!-- Info Alert -->
                        <div class="col-12">
                            <div class="alert alert-info d-flex align-items-center mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                <span id="stockInfo">Select a product to see current stock</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="submitBtn">
                        <i class="fas fa-save me-2"></i>Record Stock In
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Transaction Details Modal -->
<div class="modal fade" id="transactionDetailsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle me-2"></i>Transaction Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="transactionDetailsContent">
                <div class="text-center py-3">
                    <div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --info-gradient: linear-gradient(135deg, #5f2c82 0%, #49a09d 100%);
        --shadow-soft: 0 10px 30px -12px rgba(0, 0, 0, 0.15);
        --shadow-hover: 0 20px 40px -15px rgba(0, 0, 0, 0.25);
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Enhanced Header (from activity logs) */
    .modern-header-enhanced {
        background: white;
        border-bottom: 2px solid #667eea;
        position: relative;
        overflow: hidden;
        width: 100%;
        z-index: 1;
        animation: slideDownIn 0.6s ease-out;
    }

    .modern-header-enhanced::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: min(250px, 30vw);
        height: min(250px, 30vw);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0.03;
        border-radius: 50%;
        transform: rotate(25deg);
        pointer-events: none;
        z-index: 0;
    }

    .header-icon-enhanced {
        width: clamp(45px, 6vw, 55px);
        height: clamp(45px, 6vw, 55px);
        background: var(--primary-gradient);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: clamp(1.2rem, 3vw, 1.8rem);
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        animation: scaleIn 0.6s ease-out;
    }

    /* Stat Cards Enhanced (from activity logs) */
    .stat-card-modern {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        border: 1px solid rgba(102,126,234,0.1);
        transition: var(--transition-smooth);
        animation: fadeInUp 0.6s ease-out;
        max-width: 100%;
        overflow: hidden;
    }

    .stat-card-modern:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(102,126,234,0.15);
        border-color: #667eea;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.6rem;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .stat-icon.bg-primary { background: var(--primary-gradient); }
    .stat-icon.bg-success { background: var(--success-gradient); }
    .stat-icon.bg-warning { background: var(--warning-gradient); }
    .stat-icon.bg-info { background: var(--info-gradient); }

    .min-width-0 { min-width: 0; }

    .stat-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.9;
        display: block;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 1.6rem;
        font-weight: 700;
        line-height: 1.2;
        display: block;
        word-break: break-word;
    }

    /* Animations (from activity logs) */
    @keyframes slideDownIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    /* Keep all your existing styles below – they are still needed for the rest of the page */
    /* Modern Header (original) – we keep it for reference but the new one overrides */
    /* ... your existing styles ... */

    /* ===== MODERN STYLES (keep everything else) ===== */
    /* ... (all your original CSS from .modern-header, .stat-card, etc. is still present) ... */
    /* I'll include the essential ones, but you should keep your full original CSS block here. */
    /* For brevity, I'm only showing the new additions; in practice, merge both. */

    /* Buttons, tables, modals, etc. remain as you had them. */
</style>
@endpush

@push('scripts')
<!-- Your original scripts – unchanged -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Initialize Select2
    $('#productSelect').select2({
        dropdownParent: $('#newStockInModal'),
        width: '100%',
        placeholder: '-- Select Product --'
    });

    // Product selection change handler
    $('#productSelect').on('change', function() {
        const selected = $(this).find('option:selected');
        const stock = selected.data('stock') || 0;
        const price = selected.data('price') || 0;
        
        $('#currentStockDisplay').val(stock);
        $('#unitCost').val(price);
        $('#stockInfo').text(`Current stock: ${stock} units. New stock will be added to inventory.`);
        
        updateTotalCost();
    });

    // Quantity and unit cost input handlers
    $('#quantity, #unitCost').on('input', function() {
        updateTotalCost();
    });

    // Calculate total cost
    function updateTotalCost() {
        const quantity = parseFloat($('#quantity').val()) || 0;
        const unitCost = parseFloat($('#unitCost').val()) || 0;
        const total = quantity * unitCost;
        
        $('#totalCostDisplay').val('₱' + total.toFixed(2));
    }

    // Reset form when modal is closed
    $('#newStockInModal').on('hidden.bs.modal', function() {
        $('#stockInForm')[0].reset();
        $('#productSelect').val(null).trigger('change');
        $('#currentStockDisplay').val('0');
        $('#totalCostDisplay').val('₱0.00');
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').empty();
    });
});

// Stock In Form Submission
document.getElementById('stockInForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Reset validation
    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    document.querySelectorAll('.invalid-feedback').forEach(el => el.innerHTML = '');
    
    const formData = new FormData(this);
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;
    
    // Loading state
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
    submitBtn.disabled = true;
    
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
        Swal.close();
        
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                bootstrap.Modal.getInstance(document.getElementById('newStockInModal')).hide();
                window.location.reload();
            });
        } else {
            if (data.errors) {
                Object.keys(data.errors).forEach(key => {
                    const input = document.querySelector(`[name="${key}"]`);
                    if (input) {
                        input.classList.add('is-invalid');
                        const errorDiv = document.getElementById(`${key}Error`) || input.nextElementSibling;
                        if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                            errorDiv.innerHTML = data.errors[key].join('<br>');
                        }
                    }
                });
                
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please check the form and try again.'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data.message || 'Something went wrong.'
                });
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.close();
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Network error occurred. Please try again.'
        });
    })
    .finally(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});

// View transaction details
function viewDetails(id) {
    const modal = new bootstrap.Modal(document.getElementById('transactionDetailsModal'));
    const contentDiv = document.getElementById('transactionDetailsContent');
    
    fetch(`/admin/inventory/transaction/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const t = data.transaction;
                contentDiv.innerHTML = `
                    <table class="table table-sm table-borderless">
                        <tr><td class="text-muted">ID:</td><td class="fw-semibold">#${t.id}</td></tr>
                        <tr><td class="text-muted">Date:</td><td>${new Date(t.created_at).toLocaleString()}</td></tr>
                        <tr><td class="text-muted">Product:</td><td>${t.product?.product_name || 'N/A'}</td></tr>
                        <tr><td class="text-muted">Quantity:</td><td><span class="badge bg-success">+${t.quantity}</span></td></tr>
                        <tr><td class="text-muted">Unit Cost:</td><td>₱${(t.unit_cost || 0).toFixed(2)}</td></tr>
                        <tr><td class="text-muted">Total Cost:</td><td class="fw-bold text-primary">₱${(t.quantity * (t.unit_cost || 0)).toFixed(2)}</td></tr>
                        <tr><td class="text-muted">Reference:</td><td>${t.reference || '—'}</td></tr>
                        <tr><td class="text-muted">User:</td><td>${t.user?.name || 'System'}</td></tr>
                    </table>
                `;
            } else {
                contentDiv.innerHTML = '<p class="text-danger text-center">Failed to load details.</p>';
            }
        })
        .catch(() => {
            contentDiv.innerHTML = '<p class="text-danger text-center">Error loading details.</p>';
        });
    
    modal.show();
}

// Void transaction
function voidTransaction(id, productName, quantity) {
    Swal.fire({
        title: 'Void Transaction?',
        html: `This will remove <strong>${quantity}</strong> units of <strong>${productName || 'this product'}</strong> from inventory.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Yes, void it',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Processing...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
            
            fetch(`/admin/inventory/transaction/${id}/void`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Voided!',
                        text: data.message,
                        timer: 2000
                    }).then(() => window.location.reload());
                } else {
                    Swal.fire('Error!', data.message || 'Failed to void transaction.', 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error!', 'Network error occurred.', 'error');
            });
        }
    });
}
</script>
@endpush        