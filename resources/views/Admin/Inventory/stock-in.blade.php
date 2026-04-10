@extends('layouts.admin')

@section('title', 'Stock In - CJ\'s Minimart')

@section('content')
<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="header-card-white mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <div class="header-icon-box-new bg-primary text-white me-3">
                    <i class="fas fa-arrow-down"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0">Stock In</h4>
                    <p class="text-muted small mb-0">Record incoming inventory and purchase receipts</p>
                </div>
            </div>
            <div class="header-actions">
                <button class="btn btn-new-action" data-bs-toggle="modal" data-bs-target="#newStockInModal">
                    <i class="fas fa-plus-circle me-2"></i> New Stock In
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mx-0 g-3 mb-4" id="statsContainer">
        <div class="col-6 col-md-3">
            <div class="stat-card-white p-3 h-100">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon-new bg-indigo-soft text-indigo">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div>
                        <span class="stat-label-new">TOTAL</span>
                        <div class="stat-value-new">{{ number_format($transactions->total()) }}</div>
                    </div>
                </div>
                <div class="stat-footer-new">
                    <i class="fas fa-database"></i> {{ $transactions->count() }} this page
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card-white p-3 h-100">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon-new bg-orange-soft text-orange">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div>
                        <span class="stat-label-new">QUANTITY IN</span>
                        <div class="stat-value-new">{{ number_format($transactions->sum('quantity')) }}</div>
                    </div>
                </div>
                <div class="stat-footer-new">
                    <i class="fas fa-cubes"></i> units received
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card-white p-3 h-100">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon-new bg-yellow-soft text-yellow">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <span class="stat-label-new">VALUE ADDED</span>
                        <div class="stat-value-new">₱{{ number_format($transactions->sum('total_cost') ?? 0, 0) }}</div>
                    </div>
                </div>
                <div class="stat-footer-new">
                    <i class="fas fa-coins"></i> inventory value
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card-white p-3 h-100">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon-new bg-purple-soft text-purple">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                        <span class="stat-label-new">THIS MONTH</span>
                        <div class="stat-value-new">{{ number_format($monthlyCount ?? 0) }}</div>
                    </div>
                </div>
                <div class="stat-footer-new">
                    <i class="fas fa-calendar"></i> {{ now()->format('F Y') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mx-0 mb-4 px-3 px-md-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 p-md-4">
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

                    <form method="GET" action="{{ route('admin.inventory.stock-in') }}" id="filterForm">
                        <div class="row g-2">
                            <div class="col-12 col-md-4">
                                <label class="form-label small text-muted mb-1">Search Product</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-search text-primary"></i>
                                    </span>
                                    <input type="text" name="search" class="form-control" placeholder="Search product..." value="{{ request('search') }}">
                                </div>
                            </div>
                            
                            <div class="col-6 col-md-2">
                                <label class="form-label small text-muted mb-1">From</label>
                                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                            </div>
                            
                            <div class="col-6 col-md-2">
                                <label class="form-label small text-muted mb-1">To</label>
                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                            </div>
                            
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
                                    <th class="py-3">SUPPLIER</th>
                                    <th class="py-3 text-center">QUANTITY</th>
                                    <th class="py-3 text-end">UNIT COST</th>
                                    <th class="py-3 text-end">TOTAL COST</th>
                                    <th class="py-3">TRANSACTION NO.</th>
                                    <th class="py-3">USER</th>
                                    <th class="text-end px-4 py-3">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(is_countable($transactions) ? count($transactions) > 0 : !empty($transactions))
                                @foreach($transactions as $transaction)
                                @php
                                    $unitCost = $transaction->unit_cost ?? 0;
                                    $totalCost = $transaction->quantity * $unitCost;
                                @endphp
                                <tr>
                                    <td class="px-4">
                                        <div class="d-flex align-items-center">
                                            <div class="me-2 rounded-circle bg-primary bg-opacity-10 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                <i class="fas fa-calendar-day text-primary" style="font-size: 0.85rem;"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $transaction->created_at ? $transaction->created_at->format('M d, Y') : 'N/A' }}</div>
                                                <small class="text-muted">{{ $transaction->created_at ? $transaction->created_at->format('h:i A') : '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                                                <i class="fas fa-box text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-truncate" style="max-width:200px;">{{ Str::limit($transaction->product->product_name ?? 'Deleted Product', 30) }}</div>
                                                <small class="text-muted">{{ $transaction->product->product_code ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-truck text-muted me-2"></i>
                                            <span class="text-muted">{{ $transaction->supplier->supplier_name ?? '—' }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            <i class="fas fa-arrow-up me-1"></i>+{{ number_format($transaction->quantity) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-medium">₱{{ number_format($unitCost, 2) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-primary">₱{{ number_format($totalCost, 2) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                            {{ $transaction->reference ?? '—' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar-initials-xs rounded-circle bg-info bg-opacity-10 text-info me-2">
                                                {{ $transaction->user ? substr($transaction->user->name ?? 'S', 0, 1) : 'S' }}
                                            </span>
                                            <span class="small">{{ $transaction->user->name ?? 'System' }}</span>
                                        </div>
                                    </td>
                                    <td class="text-end px-4">
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-outline-info" onclick="viewDetails({{ $transaction->id }})" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @if ($transaction->created_at->diffInHours(now()) < 24)
                                            <button class="btn btn-sm btn-outline-danger" onclick="voidTransaction({{ $transaction->id }}, '{{ $transaction->product->product_name ?? '' }}', {{ $transaction->quantity }})" title="Void Transaction">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">No stock in records found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="d-block d-md-none p-3">
                        @if(is_countable($transactions) ? count($transactions) > 0 : !empty($transactions))
                        @foreach($transactions as $transaction)
                        <div class="mobile-card mb-3 p-3 border rounded shadow-sm bg-white">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <div class="fw-semibold">{{ Str::limit($transaction->product->product_name ?? 'Deleted Product', 30) }}</div>
                                    <small class="text-muted">{{ $transaction->product->product_code ?? '' }}</small>
                                </div>
                                <span class="badge bg-success">+{{ number_format($transaction->quantity) }}</span>
                            </div>
                            <div class="row g-2 small text-muted mb-3">
                                <div class="col-6">Date: {{ $transaction->created_at ? $transaction->created_at->format('M d, Y') : 'N/A' }}</div>
                                <div class="col-6 text-end">PO: {{ $transaction->reference ?? '—' }}</div>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-sm btn-outline-info" onclick="viewDetails({{ $transaction->id }})">View</button>
                                @if ($transaction->created_at->diffInHours(now()) < 24)
                                <button class="btn btn-sm btn-outline-danger" onclick="voidTransaction({{ $transaction->id }}, '{{ $transaction->product->product_name ?? '' }}', {{ $transaction->quantity }})">Void</button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="text-center py-5 text-muted">No stock in records found.</div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if ($transactions->hasPages())
                    <div class="p-3 border-top">
                        {{ $transactions->withQueryString()->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Stock In Modal -->
<div class="modal fade" id="newStockInModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
            <div class="modal-header border-0 p-4" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
                <div class="d-flex align-items-center flex-grow-1">
                    <div>
                        <h5 class="modal-title fw-bold mb-0">Record New Stock In</h5>
                        <p class="small mb-0 opacity-75">Receive products from suppliers into inventory</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="stockInForm" method="POST" action="{{ route('admin.inventory.process-stock-in') }}">
                @csrf
                <input type="hidden" name="type" value="in">
                
                <div class="modal-body p-4 bg-white">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="show-modal-section-label">
                                <i class="fas fa-info me-1"></i> Transaction Info
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="supplierSelect">Supplier <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-truck text-muted"></i></span>
                                <select name="supplier_id" class="form-select select2 border-start-0" id="supplierSelect" required>
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="receivedDate">Received Date <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="far fa-calendar-alt text-muted"></i></span>
                                <input type="date" name="received_date" class="form-control border-start-0" id="receivedDate" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="receivedBy">Received By <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="far fa-user text-muted"></i></span>
                                <input type="text" name="received_by" class="form-control border-start-0" id="receivedBy" value="{{ auth()->user()->name }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="show-modal-section-label">
                                <i class="fas fa-search me-1"></i> Product Selection
                            </div>
                        </div>
        
                        <div class="col-12">
                            <div class="p-3 rounded-4 border bg-light bg-opacity-50">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="productSelect">Select Product <span class="text-danger">*</span></label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-white border-end-0 px-3">
                                                <i class="fas fa-box text-primary"></i>
                                            </span>
                                            <select name="product_id" class="form-select select2 border-start-0" id="productSelect" required disabled>
                                                <option value="">-- Choose Supplier First --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="show-modal-section-label">
                                <i class="fas fa-calculator me-1"></i> Quantity & Pricing
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="metric-input-card border rounded-4 p-3 h-100">
                                <label class="form-label fw-bold small text-muted text-uppercase mb-1 d-block" for="quantity">Quantity</label>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                                        <i class="fas fa-cubes"></i>
                                    </div>
                                    <input type="number" name="quantity" class="form-control form-control-lg fw-bold border-0 bg-transparent fs-3 p-0" step="0.01" min="0.01" id="quantity" placeholder="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="metric-input-card border rounded-4 p-3 h-100">
                                <label class="form-label fw-bold small text-muted text-uppercase mb-1 d-block" for="unitCost">Unit Cost</label>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-2">
                                        <i class="fas fa-tags"></i>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <span class="fw-bold text-muted me-1 fs-5">₱</span>
                                        <input type="number" name="unit_cost" class="form-control form-control-lg fw-bold border-0 bg-transparent fs-3 p-0" step="0.01" min="0" id="unitCost" value="0.00" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 bg-primary bg-opacity-10 rounded-4 border border-primary border-opacity-25 h-100 text-center">
                                <label class="form-label fw-bold small text-primary text-uppercase mb-1">Total Cost</label>
                                <div class="fs-3 fw-bold text-primary" id="finalTotalCost">₱ 0.00</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-secondary bg-opacity-10 rounded-4 border border-secondary border-opacity-25 shadow-sm">
                                <label class="form-label fw-bold small text-secondary text-uppercase mb-1">Current Inventory Level</label>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-warehouse text-secondary opacity-50"></i>
                                    <div class="fs-4 fw-bold text-secondary" id="finalCurrentStock">0 units</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1">Movement Type</label>
                            <div class="stock-type-group d-flex flex-wrap gap-2 mt-1">
                                <input type="radio" class="btn-check" name="reason" id="typeNew" value="purchase" checked>
                                <label class="btn btn-outline-success btn-sm rounded-pill px-3" for="typeNew">Purchase</label>

                                <input type="radio" class="btn-check" name="reason" id="typeReturn" value="return">
                                <label class="btn btn-outline-warning btn-sm rounded-pill px-3" for="typeReturn">Return</label>

                                <input type="radio" class="btn-check" name="reason" id="typeAdj" value="adjustment">
                                <label class="btn btn-outline-info btn-sm rounded-pill px-3" for="typeAdj">Adjustment</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="show-modal-section-label">
                                <i class="fas fa-file-alt me-1"></i> Additional Details
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="reference">PO Number</label>
                            <input type="text" name="reference" class="form-control" id="reference" placeholder="e.g. PO-2024-001">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="location">Location</label>
                            <input type="text" name="location" class="form-control" id="location" placeholder="e.g. Warehouse A">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="notes">Notes</label>
                            <textarea name="notes" class="form-control" id="notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 p-4 bg-light">
                    <button type="button" class="btn btn-link text-muted fw-bold text-decoration-none px-4" data-bs-dismiss="modal">Discard</button>
                    <div class="ms-auto d-flex gap-2">
                        <button type="button" class="btn btn-outline-success fw-bold rounded-pill px-4" id="saveAndNewBtn">
                            Save & New
                        </button>
                        <button type="submit" class="btn btn-success fw-bold rounded-pill px-4 shadow-sm" id="submitBtn">
                            Complete Stock In
                        </button>
                    </div>
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
                <h5 class="modal-title">Transaction Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="transactionDetailsContent">
                <div class="text-center py-3">
                    <div class="spinner-border text-info" role="status"></div>
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
    /* Page-specific skeleton (if needed for local use) */
    #skeletonLoader {
        position: fixed;
        top: 0;
        left: var(--sidebar-width);
        width: calc(100% - var(--sidebar-width));
        height: 100%;
        background: var(--bg-color);
        z-index: 1000;
        display: none;
    }
    
    #skeletonLoader.active {
        display: block;
    }
    
    @media (max-width: 991.98px) {
        #skeletonLoader {
            left: 0;
            width: 100%;
        }
    }

    .header-card-white { background: white; padding: 24px 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); margin: 0 1.5rem; }
    .header-icon-box-new { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2); background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important; }
    .btn-new-action { border: 1.5px solid #212529; border-radius: 12px; padding: 8px 24px; font-weight: 600; background: white; color: #212529; transition: all 0.2s; }
    .btn-new-action:hover { background: #212529; color: white; }
    .stat-card-white { background: white; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.02); }
    .stat-icon-new { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
    .bg-indigo-soft { background: #eef2ff; } .text-indigo { color: #6366f1; }
    .bg-orange-soft { background: #fff7ed; } .text-orange { color: #f97316; }
    .bg-yellow-soft { background: #fefce8; } .text-yellow { color: #eab308; }
    .bg-purple-soft { background: #faf5ff; } .text-purple { color: #a855f7; }
    .stat-label-new { font-size: 0.7rem; font-weight: 700; color: #94a3b8; letter-spacing: 0.05em; }
    .stat-value-new { font-size: 1.8rem; font-weight: 800; color: #1e293b; line-height: 1; }
    .stat-footer-new { margin-top: 15px; font-size: 0.75rem; color: #64748b; display: flex; align-items: center; gap: 5px; }
    .show-modal-section-label { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #10b981; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
    .show-modal-section-label::after { content: ''; flex: 1; height: 1.5px; background: linear-gradient(to right, rgba(16, 185, 129, 0.25), transparent); border-radius: 2px; }
    .metric-input-card { background: #f0fdf4; border: 1px solid #d1fae5; }
    .metric-input-card:focus-within { background: #fff; border-color: #10b981 !important; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15); }
    .input-group .select2-container--default { flex: 1 1 auto; width: 1% !important; }
    .input-group .select2-container--default .select2-selection--single { height: 100% !important; border: 1px solid #dee2e6 !important; border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; display: flex; align-items: center; padding-top: 0.375rem; padding-bottom: 0.375rem; }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#productSelect, #supplierSelect').select2({
        dropdownParent: $('#newStockInModal'),
        width: '100%',
        placeholder: "-- Select --"
    });

    $('#supplierSelect').on('change', function() {
        const supplierId = $(this).val();
        const productSelect = $('#productSelect');
        productSelect.empty().append('<option value="">Select Product</option>');
        
        if (!supplierId) {
            productSelect.prop('disabled', true);
            return;
        }
        
        productSelect.prop('disabled', false);
        fetch(`{{ url('api/suppliers') }}/${supplierId}/products`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.products) {
                    data.products.forEach(p => {
                        const option = new Option(`${p.product_name} (${p.product_code})`, p.id);
                        $(option).attr('data-stock', p.stock ? p.stock.quantity : 0);
                        $(option).attr('data-price', p.cost_price || 0);
                        $(option).attr('data-unit', p.unit || 'units');
                        productSelect.append(option);
                    });
                    productSelect.trigger('change');
                }
            });
    });

    $('#productSelect').on('change', function() {
        const option = $(this).find('option:selected');
        $('#finalCurrentStock').text((option.data('stock') || 0) + ' ' + (option.data('unit') || 'units'));
        $('#unitCost').val((option.data('price') || 0).toFixed(2));
        updateTotal();
    });

    $('#quantity, #unitCost').on('input', updateTotal);

    function updateTotal() {
        const q = parseFloat($('#quantity').val()) || 0;
        const c = parseFloat($('#unitCost').val()) || 0;
        $('#finalTotalCost').text('₱ ' + (q * c).toLocaleString(undefined, {minimumFractionDigits: 2}));
    }

    $('#stockInForm').on('submit', function(e) {
        e.preventDefault();
        const btn = $('#submitBtn');
        btn.prop('disabled', true).html('Saving...');
        
        fetch(this.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            body: new FormData(this)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Success', data.message, 'success').then(() => window.location.reload());
            } else {
                Swal.fire('Error', data.message || 'Validation failed', 'error');
                btn.prop('disabled', false).html('Complete Stock In');
            }
        });
    });
});

function viewDetails(id) {
    const modal = new bootstrap.Modal(document.getElementById('transactionDetailsModal'));
    fetch(`/admin/inventory/transaction/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const t = data.transaction;
                document.getElementById('transactionDetailsContent').innerHTML = `
                    <p><strong>Product:</strong> ${t.product?.product_name}</p>
                    <p><strong>Quantity:</strong> +${t.quantity}</p>
                    <p><strong>Cost:</strong> ₱${(t.unit_cost || 0).toFixed(2)}</p>
                    <p><strong>Total:</strong> ₱${(t.quantity * (t.unit_cost || 0)).toFixed(2)}</p>
                    <p><strong>Date:</strong> ${new Date(t.created_at).toLocaleString()}</p>
                `;
                modal.show();
            }
        });
}

function voidTransaction(id, name, qty) {
    Swal.fire({
        title: 'Void?',
        text: `Void ${qty} units of ${name}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes'
    }).then(r => {
        if (r.isConfirmed) {
            fetch(`/admin/inventory/transaction/${id}/void`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(() => window.location.reload());
        }
    });
}
</script>
@endpush
