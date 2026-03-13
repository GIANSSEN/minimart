@extends('layouts.admin')

@section('title', 'Inventory Dashboard - CJ\'s Minimart')

@section('content')
<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="row mx-0 mb-4">
        <div class="col-12 px-0">
            <div class="modern-header d-flex flex-wrap align-items-center justify-content-between gap-3 py-3 px-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="header-icon">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-0" style="font-size: clamp(1.8rem, 4vw, 2.2rem);">Inventory Dashboard</h1>
                        <p class="text-muted mb-0">Monitor stock levels, track movements, and manage inventory</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.inventory.stock-in') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-down me-2"></i>Stock In
                    </a>
                    <a href="{{ route('admin.inventory.stock-out') }}" class="btn btn-warning">
                        <i class="fas fa-arrow-up me-2"></i>Stock Out
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards - LARGER & WIDER -->
    <div class="row mx-0 g-3 mb-4">
        <div class="col-xl-3 col-md-6 d-flex px-2">
            <div class="stat-card flex-fill w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="stat-details">
                        <span class="stat-label">Total Products</span>
                        <span class="stat-value">{{ $stats['total_products'] }}</span>
                        <span class="stat-trend">
                            <i class="fas fa-package me-1"></i>All products
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 d-flex px-2">
            <div class="stat-card flex-fill w-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stat-details">
                        <span class="stat-label">Low Stock</span>
                        <span class="stat-value">{{ $stats['low_stock'] }}</span>
                        @if($stats['low_stock'] > 0)
                            <span class="stat-trend">
                                <a href="{{ route('admin.inventory.alerts', ['type' => 'low']) }}" class="text-white text-decoration-none">
                                    <i class="fas fa-arrow-right me-1"></i>{{ $stats['low_stock'] }} items need attention
                                </a>
                            </span>
                        @else
                            <span class="stat-trend">
                                <i class="fas fa-check-circle me-1"></i>All stock levels healthy
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 d-flex px-2">
            <div class="stat-card flex-fill w-100" style="background: linear-gradient(135deg, #5f2c82 0%, #49a09d 100%);">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-details">
                        <span class="stat-label">Near Expiry</span>
                        <span class="stat-value">{{ $stats['near_expiry'] }}</span>
                        @if($stats['near_expiry'] > 0)
                            <span class="stat-trend">
                                <a href="{{ route('admin.inventory.alerts', ['type' => 'near']) }}" class="text-white text-decoration-none">
                                    <i class="fas fa-arrow-right me-1"></i>{{ $stats['near_expiry'] }} items expiring soon
                                </a>
                            </span>
                        @else
                            <span class="stat-trend">
                                <i class="fas fa-calendar-check me-1"></i>No items near expiry
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 d-flex px-2">
            <div class="stat-card flex-fill w-100" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="stat-details">
                        <span class="stat-label">Inventory Value</span>
                        <span class="stat-value">₱{{ number_format($stats['total_value'] ?? 0, 2) }}</span>
                        <span class="stat-trend">
                            <i class="fas fa-chart-line me-1"></i>Total investment
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid - CENTERED DATAGRID -->
    <div class="row mx-0 g-4">
        <!-- Recent Transactions - CENTERED -->
        <div class="col-lg-6 px-2">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="mb-0">
                        <i class="fas fa-history text-primary me-2"></i>
                        Recent Stock Movements
                    </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.inventory.stock-in') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-arrow-down me-1"></i>Stock In
                        </a>
                        <a href="{{ route('admin.inventory.stock-out') }}" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-arrow-up me-1"></i>Stock Out
                        </a>
                        <a href="{{ route('admin.inventory.all-history') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-eye me-1"></i>View All
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">Product</th>
                                    <th class="py-3 text-center">Type</th>
                                    <th class="py-3 text-center">Qty</th>
                                    <th class="py-3">Date</th>
                                    <th class="py-3 text-end px-4">User</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTransactions as $transaction)
                                <tr>
                                    <td class="px-4">
                                        <div class="d-flex align-items-center">
                                            @if($transaction->product && $transaction->product->image)
                                                <img src="{{ asset($transaction->product->image) }}" 
                                                     class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                                     style="width: 32px; height: 32px;">
                                                    <i class="fas fa-box fa-sm text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ Str::limit($transaction->product->product_name ?? 'Deleted Product', 20) }}</div>
                                                <small class="text-muted">{{ $transaction->product->product_code ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($transaction->type == 'in')
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                                <i class="fas fa-arrow-down me-1"></i> IN
                                            </span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                                <i class="fas fa-arrow-up me-1"></i> OUT
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold">{{ $transaction->quantity }}</span>
                                    </td>
                                    <td>
                                        <span title="{{ $transaction->created_at ? $transaction->created_at->format('M d, Y h:i A') : '' }}">
                                            {{ $transaction->created_at ? $transaction->created_at->diffForHumans() : 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="text-end px-4">
                                        <span class="badge bg-light text-dark">
                                            {{ $transaction->user->full_name ?? $transaction->user->name ?? 'System' }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-exchange-alt fa-4x text-muted mb-3"></i>
                                            <h6 class="text-muted">No Recent Transactions</h6>
                                            <p class="text-muted small">Stock movements will appear here</p>
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

        <!-- Low Stock Alerts - CENTERED -->
        <div class="col-lg-6 px-2">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        Low Stock Alerts
                        @if($stats['low_stock'] > 0)
                            <span class="badge bg-warning text-dark ms-2">{{ $stats['low_stock'] }}</span>
                        @endif
                    </h5>
                    <a href="{{ route('admin.inventory.alerts') }}" class="btn btn-sm btn-outline-warning">
                        View All Alerts <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">Product</th>
                                    <th class="py-3 text-center">Current</th>
                                    <th class="py-3 text-center">Minimum</th>
                                    <th class="py-3 text-center">Status</th>
                                    <th class="text-end px-4 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lowStockProducts as $product)
                                <tr>
                                    <td class="px-4">
                                        <div class="d-flex align-items-center">
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}" 
                                                     class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                                     style="width: 32px; height: 32px;">
                                                    <i class="fas fa-box fa-sm text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ Str::limit($product->product_name, 20) }}</div>
                                                <small class="text-muted">{{ $product->product_code }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $stockQty = $product->stock->quantity ?? 0;
                                            $textClass = $stockQty <= 0 ? 'danger' : 'warning';
                                        @endphp
                                        <span class="fw-bold text-{{ $textClass }}">{{ $stockQty }}</span>
                                    </td>
                                    <td class="text-center">{{ $product->stock->min_quantity ?? $product->reorder_level ?? 5 }}</td>
                                    <td class="text-center">
                                        @if($stockQty <= 0)
                                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i> Out of Stock
                                            </span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                                <i class="fas fa-exclamation-triangle me-1"></i> Low Stock
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-end px-4">
                                        <button class="btn btn-sm btn-primary" onclick="showStockInModal({{ $product->id }}, '{{ $product->product_name }}')">
                                            <i class="fas fa-plus me-1"></i> Restock
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                                            <h6 class="text-muted">No Low Stock Alerts</h6>
                                            <p class="text-muted small">All products are at healthy levels</p>
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

    <!-- Quick Actions Row -->
    <div class="row mx-0 mt-4 g-3">
        <div class="col-md-3 px-2">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <i class="fas fa-boxes fa-3x text-primary mb-3"></i>
                    <h6>Stock In</h6>
                    <p class="small text-muted">Add new stock to inventory</p>
                    <a href="{{ route('admin.inventory.stock-in') }}" class="btn btn-sm btn-primary w-100">Go to Stock In</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 px-2">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <i class="fas fa-arrow-up fa-3x text-warning mb-3"></i>
                    <h6>Stock Out</h6>
                    <p class="small text-muted">Remove stock from inventory</p>
                    <a href="{{ route('admin.inventory.stock-out') }}" class="btn btn-sm btn-warning w-100">Go to Stock Out</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 px-2">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                    <h6>Inventory Alerts</h6>
                    <p class="small text-muted">Check low stock & expiry</p>
                    <a href="{{ route('admin.inventory.alerts') }}" class="btn btn-sm btn-danger w-100">View Alerts</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 px-2">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <i class="fas fa-history fa-3x text-info mb-3"></i>
                    <h6>Stock History</h6>
                    <p class="small text-muted">View all stock movements</p>
                    <a href="{{ route('admin.inventory.all-history') }}" class="btn btn-sm btn-info text-white w-100">View History</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stock In Modal (Enhanced) -->
<div class="modal fade" id="stockInModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-arrow-down me-2"></i>Add Stock
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="stockInForm" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="stock_product_id">
                    <input type="hidden" name="type" value="in">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Product</label>
                        <input type="text" class="form-control bg-light" id="stock_product_name" readonly>
                        <div id="productInfo" class="small text-muted mt-1"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" class="form-control" step="0.01" min="0.01" id="quantity" required>
                        <div class="invalid-feedback" id="quantityError"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Unit Cost</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="number" name="unit_cost" class="form-control" step="0.01" min="0" id="unitCost">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Total Cost</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control bg-light" id="totalCost" readonly>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Reference</label>
                        <input type="text" name="reference" class="form-control" placeholder="PO-12345, Invoice #">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Expiry Date</label>
                        <input type="date" name="expiry_date" class="form-control" id="expiryDate">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Notes</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Additional notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Add Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success/Error Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3"></div>
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
    
    .col-12.px-0,
    [class*="col-"].px-2 {
        padding-left: 0.5rem !important;
        padding-right: 0.5rem !important;
    }

    /* MODERN HEADER */
    .modern-header {
        background: white;
        border-bottom: 2px solid #0d6efd;
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0.03;
        border-radius: 50%;
        transform: rotate(25deg);
    }

    .header-icon {
        width: clamp(55px, 6vw, 65px);
        height: clamp(55px, 6vw, 65px);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: clamp(1.8rem, 4vw, 2.2rem);
        box-shadow: 0 10px 20px rgba(102,126,234,0.3);
        flex-shrink: 0;
        z-index: 2;
    }

    /* STAT CARDS - BIGGER & WIDER */
    .stat-card {
        border-radius: 20px;
        padding: 2rem 1.5rem;
        color: white;
        position: relative;
        overflow: hidden;
        min-height: 160px;
        width: 100%;
        transition: all 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 150px;
        height: 150px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    .stat-card .stat-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        position: relative;
        z-index: 2;
        height: 100%;
    }

    .stat-card .stat-icon {
        width: clamp(60px, 5vw, 70px);
        height: clamp(60px, 5vw, 70px);
        background: rgba(255,255,255,0.2);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(2rem, 4vw, 2.5rem);
        backdrop-filter: blur(5px);
        flex-shrink: 0;
    }

    .stat-card .stat-label {
        font-size: clamp(0.9rem, 1.5vw, 1rem);
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.9;
        display: block;
        margin-bottom: 5px;
        white-space: nowrap;
    }

    .stat-card .stat-value {
        font-size: clamp(2.2rem, 3vw, 2.8rem);
        font-weight: 700;
        line-height: 1.2;
        display: block;
        margin-bottom: 5px;
    }

    .stat-card .stat-trend {
        font-size: clamp(0.8rem, 1.5vw, 0.9rem);
        opacity: 0.9;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* CARDS */
    .card {
        border-radius: 16px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05) !important;
    }

    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
        background: white;
        padding: 1.2rem 1.5rem;
    }

    /* TABLE STYLES - CENTERED */
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

    /* BADGES */
    .badge {
        font-weight: 500;
        padding: 0.6rem 1.2rem;
        border-radius: 30px;
        font-size: 0.85rem;
    }

    /* EMPTY STATE */
    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
    }

    /* QUICK ACTION CARDS */
    .quick-action-card {
        transition: all 0.3s;
    }

    .quick-action-card:hover {
        transform: translateY(-5px);
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
            min-height: 140px;
            padding: 1.5rem;
        }

        .stat-card .stat-value {
            font-size: 1.8rem;
        }

        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
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
    // Show Stock In Modal with validation
    function showStockInModal(id, name) {
        document.getElementById('stock_product_id').value = id;
        document.getElementById('stock_product_name').value = name;
        
        // Reset form
        document.getElementById('stockInForm').reset();
        document.getElementById('stock_product_id').value = id;
        document.getElementById('stock_product_name').value = name;
        document.getElementById('totalCost').value = '0.00';
        
        // Fetch current stock info
        fetch(`/admin/inventory/product/${id}/stock`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('productInfo').innerHTML = `
                        <strong>Current Stock:</strong> ${data.current_stock} ${data.unit} | 
                        <strong>Location:</strong> ${data.location}
                    `;
                }
            })
            .catch(error => console.error('Error:', error));
        
        const modal = new bootstrap.Modal(document.getElementById('stockInModal'));
        modal.show();
    }

    // Calculate total cost
    document.getElementById('quantity')?.addEventListener('input', calculateTotal);
    document.getElementById('unitCost')?.addEventListener('input', calculateTotal);

    function calculateTotal() {
        const quantity = parseFloat(document.getElementById('quantity')?.value) || 0;
        const unitCost = parseFloat(document.getElementById('unitCost')?.value) || 0;
        const total = quantity * unitCost;
        document.getElementById('totalCost').value = total.toFixed(2);
        
        // Validate quantity
        if (quantity <= 0) {
            document.getElementById('quantity').classList.add('is-invalid');
            document.getElementById('quantityError').innerText = 'Quantity must be greater than 0';
        } else {
            document.getElementById('quantity').classList.remove('is-invalid');
        }
    }

    // Stock In Form Submission
    document.getElementById('stockInForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate quantity
        const quantity = parseFloat(document.getElementById('quantity')?.value) || 0;
        if (quantity <= 0) {
            document.getElementById('quantity').classList.add('is-invalid');
            document.getElementById('quantityError').innerText = 'Quantity must be greater than 0';
            return;
        }
        
        const formData = new FormData(this);
        
        Swal.fire({
            title: 'Processing Stock In...',
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
                let errorMsg = data.message || 'Something went wrong.';
                if (data.errors) {
                    errorMsg = Object.values(data.errors).flat().join('\n');
                }
                Swal.fire('Error!', errorMsg, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', 'Network error occurred. Please try again.', 'error');
        });
    });

    // Add data-label attributes for mobile
    document.addEventListener('DOMContentLoaded', function() {
        // Recent Transactions table
        const recentTable = document.querySelectorAll('.table');
        recentTable.forEach(table => {
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

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    });
</script>
@endpush