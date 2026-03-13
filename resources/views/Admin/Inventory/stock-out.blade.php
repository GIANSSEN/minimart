@extends('layouts.admin')

@section('title', 'Stock Out - CJ\'s Minimart')

@section('content')
<div class="container-fluid px-0" style="max-width: 1400px; margin: 0 auto;" id="stock-out-page">
    <!-- Page Header Enhanced (warning theme) -->
    <div class="row mx-0 mb-4">
        <div class="col-12 px-0">
            <div class="modern-header-enhanced d-flex flex-wrap align-items-center justify-content-between gap-3 py-3 px-4" style="border-bottom-color: #f59e0b;">
                <div class="d-flex align-items-center gap-3">
                    <div class="header-icon-enhanced" style="background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-0" style="font-size: clamp(1.5rem, 4vw, 1.8rem);">Stock Out</h1>
                        <p class="text-muted mb-0 mt-2">Record outgoing inventory, sales, and adjustments</p>
                    </div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#newStockOutModal" aria-label="New stock out">
                        <i class="fas fa-minus-circle me-2"></i><span class="d-none d-sm-inline">New Stock Out</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Enhanced (4‑column) -->
    <div class="row mx-0 g-2 g-md-3 mb-4 px-3 px-md-4" id="statsContainer" role="region" aria-label="Stock out statistics">
        <!-- Total Transactions -->
        <div class="col-6 col-md-3">
            <div class="stat-card-modern p-3 h-100 d-flex flex-column" role="region" aria-label="Total transactions">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon bg-primary" title="Total transactions">
                        <i class="fas fa-exchange-alt"></i>
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

        <!-- Total Quantity Out -->
        <div class="col-6 col-md-3">
            <div class="stat-card-modern p-3 h-100 d-flex flex-column" role="region" aria-label="Total quantity out">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon bg-danger" title="Total quantity out" style="background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <div class="min-width-0">
                        <span class="stat-label text-uppercase text-muted small d-block text-truncate">Quantity Out</span>
                        <span class="stat-value fw-bold h3 text-truncate d-block" aria-label="Total quantity: {{ number_format($transactions->sum('quantity')) }}">{{ number_format($transactions->sum('quantity')) }}</span>
                    </div>
                </div>
                <div class="mt-auto small text-muted text-truncate">
                    <i class="fas fa-cubes me-1"></i><span>units removed</span>
                </div>
            </div>
        </div>

        <!-- Value Lost -->
        <div class="col-6 col-md-3">
            <div class="stat-card-modern p-3 h-100 d-flex flex-column" role="region" aria-label="Value lost">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon bg-warning" title="Value lost">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="min-width-0">
                        <span class="stat-label text-uppercase text-muted small d-block text-truncate">Value Lost</span>
                        <span class="stat-value fw-bold h3 text-truncate d-block" aria-label="Value lost: ₱{{ number_format($totalValueLost ?? 0, 2) }}">₱{{ number_format($totalValueLost ?? 0, 2) }}</span>
                    </div>
                </div>
                <div class="mt-auto small text-muted text-truncate">
                    <i class="fas fa-coins me-1"></i><span>cost of goods</span>
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

    <!-- Filter Card Enhanced (collapsible, with active tags) -->
    <div class="row mx-0 mb-4 px-3 px-md-4">
        <div class="col-12">
            <div class="card border-0 shadow-soft rounded-4 overflow-hidden filter-card-enhanced">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0 fw-semibold d-flex align-items-center">
                            <i class="fas fa-sliders-h text-gradient-secondary me-2"></i>Filter Stock Out
                        </h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.inventory.export-history', ['type' => 'out']) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-download me-1"></i>Export
                            </a>
                            <a href="{{ route('admin.inventory.stock-out') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-redo-alt me-1"></i>Reset
                            </a>
                        </div>
                    </div>
                    <div class="collapse show" id="filterCollapse">
                        <form method="GET" action="{{ route('admin.inventory.stock-out') }}" id="filterForm" class="needs-validation" novalidate>
                            <div class="row g-3">
                                <!-- Search (col-md-3) -->
                                <div class="col-md-3">
                                    <div class="input-group input-group-enhanced">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-search text-warning"></i>
                                        </span>
                                        <input type="text" name="search" class="form-control border-start-0" 
                                               placeholder="Search product..." 
                                               value="{{ request('search') }}" id="searchInput" autocomplete="off" aria-label="Search products">
                                    </div>
                                </div>

                                <!-- Reason (col-md-2) -->
                                <div class="col-md-2">
                                    <div class="input-group input-group-enhanced">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-tag text-secondary"></i>
                                        </span>
                                        <select name="reason" class="form-select border-start-0" aria-label="Filter by reason">
                                            <option value="">All Reasons</option>
                                            <option value="sale" {{ request('reason') == 'sale' ? 'selected' : '' }}>Sale</option>
                                            <option value="damage" {{ request('reason') == 'damage' ? 'selected' : '' }}>Damage</option>
                                            <option value="expired" {{ request('reason') == 'expired' ? 'selected' : '' }}>Expired</option>
                                            <option value="adjustment" {{ request('reason') == 'adjustment' ? 'selected' : '' }}>Adjustment</option>
                                            <option value="return" {{ request('reason') == 'return' ? 'selected' : '' }}>Return</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Date From (col-md-2) -->
                                <div class="col-md-2">
                                    <div class="input-group input-group-enhanced">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-calendar text-secondary"></i>
                                        </span>
                                        <input type="date" name="date_from" class="form-control border-start-0" 
                                               placeholder="From" value="{{ request('date_from') }}" id="dateFromInput" aria-label="From date">
                                    </div>
                                </div>

                                <!-- Date To (col-md-2) -->
                                <div class="col-md-2">
                                    <div class="input-group input-group-enhanced">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-calendar text-secondary"></i>
                                        </span>
                                        <input type="date" name="date_to" class="form-control border-start-0" 
                                               placeholder="To" value="{{ request('date_to') }}" id="dateToInput" aria-label="To date">
                                    </div>
                                </div>

                                <!-- Apply Button (col-md-3) -->
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-gradient-warning w-100" id="applyFilterBtn" aria-label="Apply filters">
                                        <i class="fas fa-filter me-2"></i><span class="d-none d-sm-inline">Apply</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Active Filters -->
                            @if(request()->anyFilled(['search', 'reason', 'date_from', 'date_to']))
                            <div class="mt-3 pt-3 border-top">
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light text-dark p-2">
                                        <i class="fas fa-sliders-h me-1"></i>Active Filters:
                                    </span>
                                    @if(request('search'))
                                        <span class="badge bg-primary">
                                            "{{ request('search') }}" 
                                            <a href="{{ route('admin.inventory.stock-out', array_merge(request()->except('search', 'page'))) }}" 
                                               class="text-white ms-1" title="Remove search filter">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </span>
                                    @endif
                                    @if(request('reason'))
                                        <span class="badge bg-info">
                                            {{ ucfirst(request('reason')) }}
                                            <a href="{{ route('admin.inventory.stock-out', array_merge(request()->except('reason', 'page'))) }}" 
                                               class="text-white ms-1" title="Remove reason filter">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </span>
                                    @endif
                                    @if(request('date_from'))
                                        <span class="badge bg-success">
                                            From {{ \Carbon\Carbon::parse(request('date_from'))->format('M d, Y') }}
                                            <a href="{{ route('admin.inventory.stock-out', array_merge(request()->except('date_from', 'page'))) }}" 
                                               class="text-white ms-1" title="Remove from date">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </span>
                                    @endif
                                    @if(request('date_to'))
                                        <span class="badge bg-warning text-dark">
                                            To {{ \Carbon\Carbon::parse(request('date_to'))->format('M d, Y') }}
                                            <a href="{{ route('admin.inventory.stock-out', array_merge(request()->except('date_to', 'page'))) }}" 
                                               class="text-dark ms-1" title="Remove to date">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table (9 columns) -->
    <div class="row mx-0 px-3 px-md-4" id="transactionsTableContainer" role="region" aria-label="Stock out records table">
        <div class="col-12">
            <div class="card border-0 shadow-soft rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-soft border-0 py-4 px-4">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                        <h5 class="mb-0 fw-bold d-flex align-items-center">
                            <i class="fas fa-circle text-gradient-secondary me-2" style="font-size: 0.5em;"></i>
                            Stock Out Records <span class="badge bg-secondary ms-2">{{ $transactions->total() }} total</span>
                        </h5>
                        <div>
                            <form method="GET" action="{{ route('admin.inventory.stock-out') }}" id="perPageForm" class="d-inline">
                                @foreach(request()->except('per_page', 'page') as $key => $value)
                                    @if($value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endif
                                @endforeach
                                <select name="per_page" class="form-select form-select-sm form-select-enhanced" style="width: 130px;" onchange="validatePerPage(this)" aria-label="Records per page">
                                    <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 per page</option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per page</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per page</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table modern-table align-middle mb-0" role="table">
                        <thead>
                            <tr>
                                <th class="px-4 py-3">DATE & TIME</th>
                                <th class="py-3">PRODUCT</th>
                                <th class="py-3 text-center">QUANTITY</th>
                                <th class="py-3 text-end">UNIT PRICE</th>
                                <th class="py-3 text-end">TOTAL VALUE</th>
                                <th class="py-3">REASON</th>
                                <th class="py-3">REFERENCE</th>
                                <th class="py-3">USER</th>
                                <th class="text-end px-4 py-3">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                            @php
                                $unitPrice = $transaction->product->selling_price ?? 0;
                                $totalValue = $transaction->quantity * $unitPrice;
                                $reasonColors = [
                                    'sale' => 'success',
                                    'damage' => 'danger',
                                    'expired' => 'danger',
                                    'adjustment' => 'info',
                                    'return' => 'primary'
                                ];
                                $color = $reasonColors[$transaction->reason] ?? 'secondary';
                            @endphp
                            <tr class="transaction-row" role="row">
                                <td class="px-4" data-label="Date & Time">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-day opacity-50 me-2" style="color: #f59e0b;"></i>
                                        <div>
                                            <div class="fw-semibold">{{ $transaction->created_at ? $transaction->created_at->format('M d, Y') : 'N/A' }}</div>
                                            <small class="text-muted">{{ $transaction->created_at ? $transaction->created_at->format('h:i A') : '' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Product">
                                    <div class="d-flex align-items-center">
                                        <div class="product-icon-wrapper me-2">
                                            <div class="bg-warning bg-opacity-10 rounded-2 p-2">
                                                <i class="fas fa-box text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="min-width-0">
                                            <div class="fw-semibold text-truncate" style="max-width:200px;">{{ Str::limit($transaction->product->product_name ?? 'Deleted Product', 30) }}</div>
                                            <small class="text-muted text-truncate d-block">{{ $transaction->product->product_code ?? '' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center" data-label="Quantity">
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                                        <i class="fas fa-arrow-down me-1"></i>-{{ number_format($transaction->quantity) }}
                                    </span>
                                </td>
                                <td class="text-end" data-label="Unit Price">
                                    <span class="fw-medium">₱{{ number_format($unitPrice, 2) }}</span>
                                </td>
                                <td class="text-end" data-label="Total Value">
                                    <span class="fw-bold text-primary">₱{{ number_format($totalValue, 2) }}</span>
                                </td>
                                <td data-label="Reason">
                                    <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }} px-3 py-2 rounded-pill">
                                        {{ ucfirst(str_replace('_', ' ', $transaction->reason)) }}
                                    </span>
                                </td>
                                <td data-label="Reference">
                                    @if($transaction->reference)
                                        <div class="d-flex align-items-center gap-1">
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1">{{ $transaction->reference }}</span>
                                            <button class="btn-copy btn-sm" data-clipboard-text="{{ $transaction->reference }}" title="Copy reference" aria-label="Copy reference">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td data-label="User">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar-initials-xs rounded-circle bg-info bg-opacity-10 text-info me-2">
                                            {{ $transaction->user ? substr($transaction->user->name ?? 'S', 0, 1) : 'S' }}
                                        </span>
                                        <span class="small">{{ $transaction->user->name ?? 'System' }}</span>
                                    </div>
                                </td>
                                <td class="text-end px-4" data-label="Actions">
                                    <div class="btn-group" role="group" aria-label="Transaction actions">
                                        <button class="btn btn-sm btn-outline-info" onclick="viewDetails({{ $transaction->id }})" title="View details" aria-label="View transaction {{ $transaction->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @if($transaction->created_at->diffInHours(now()) < 24)
                                        <button class="btn btn-sm btn-outline-danger" onclick="voidTransaction({{ $transaction->id }}, '{{ addslashes($transaction->product->product_name ?? '') }}', {{ $transaction->quantity }})" title="Void transaction" aria-label="Void transaction {{ $transaction->id }}">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">
                                    <div class="empty-state">
                                        <i class="fas fa-arrow-up fa-4x text-muted opacity-25 mb-4"></i>
                                        <h5 class="text-muted mb-2">No Stock Out Records</h5>
                                        <p class="text-muted mb-3">Start recording outgoing inventory.</p>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#newStockOutModal">
                                            <i class="fas fa-minus-circle me-2"></i>New Stock Out
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($transactions->hasPages())
                <div class="px-4 py-4 border-top">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <div class="text-muted small">
                            <i class="fas fa-database me-1"></i>
                            Showing <strong>{{ $transactions->firstItem() }}</strong> to <strong>{{ $transactions->lastItem() }}</strong> of <strong>{{ $transactions->total() }}</strong> entries
                        </div>
                        <div class="pagination-modern">
                            {{ $transactions->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- New Stock Out Modal (matching stock‑in) -->
<div class="modal fade" id="newStockOutModal" tabindex="-1" aria-hidden="true" aria-labelledby="newStockOutModalLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="newStockOutModalLabel">
                    <i class="fas fa-arrow-up me-2"></i>New Stock Out
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="stockOutForm" method="POST" action="{{ route('admin.inventory.process-stock-out') }}" novalidate>
                @csrf
                <input type="hidden" name="type" value="out">
                
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Product Selection -->
                        <div class="col-12">
                            <label for="productSelect" class="form-label fw-semibold">
                                Product <span class="text-danger">*</span>
                            </label>
                            <select name="product_id" class="form-select select2" id="productSelect" required>
                                <option value="">-- Select Product --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" 
                                            data-stock="{{ $product->stock->quantity ?? 0 }}"
                                            data-price="{{ $product->selling_price ?? 0 }}">
                                        {{ $product->product_name }} ({{ $product->product_code }}) 
                                        - Available: {{ $product->stock->quantity ?? 0 }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="productError"></div>
                        </div>
                        
                        <!-- Quantity -->
                        <div class="col-md-6">
                            <label for="quantity" class="form-label fw-semibold">
                                Quantity <span class="text-danger">*</span>
                            </label>
                            <input type="number" 
                                   name="quantity" 
                                   class="form-control" 
                                   step="0.01" 
                                   min="0.01" 
                                   id="quantity" 
                                   required>
                            <small class="text-muted" id="availableStockHint"></small>
                            <div class="invalid-feedback" id="quantityError"></div>
                        </div>
                        
                        <!-- Reason -->
                        <div class="col-md-6">
                            <label for="reason" class="form-label fw-semibold">
                                Reason <span class="text-danger">*</span>
                            </label>
                            <select name="reason" class="form-select" id="reason" required>
                                <option value="">Select Reason</option>
                                <option value="sale">Sale</option>
                                <option value="damage">Damage / Spoilage</option>
                                <option value="expired">Expired</option>
                                <option value="adjustment">Adjustment</option>
                                <option value="return">Return to Supplier</option>
                            </select>
                            <div class="invalid-feedback" id="reasonError"></div>
                        </div>
                        
                        <!-- Reference -->
                        <div class="col-md-6">
                            <label for="reference" class="form-label fw-semibold">
                                Reference
                            </label>
                            <input type="text" 
                                   name="reference" 
                                   class="form-control" 
                                   id="reference"
                                   placeholder="SO-12345, Invoice #">
                        </div>
                        
                        <!-- Current Stock Display -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Current Stock</label>
                            <div class="form-control bg-light" id="currentStockDisplay" readonly>0</div>
                        </div>

                        <!-- Unit Price Display -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Unit Price</label>
                            <div class="form-control bg-light" id="unitPriceDisplay" readonly>₱0.00</div>
                        </div>
                        
                        <!-- Total Value Display -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Total Value</label>
                            <div class="form-control bg-light fw-bold text-primary" id="totalValueDisplay" readonly>₱0.00</div>
                        </div>
                        
                        <!-- Notes -->
                        <div class="col-12">
                            <label for="notes" class="form-label fw-semibold">
                                Notes
                            </label>
                            <textarea name="notes" class="form-control" id="notes" rows="2" placeholder="Additional notes..."></textarea>
                        </div>
                        
                        <!-- Stock Warning -->
                        <div class="col-12" id="stockWarning" style="display: none;">
                            <div class="alert alert-warning d-flex align-items-center mb-0">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <span id="warningMessage">Warning: Quantity exceeds available stock!</span>
                            </div>
                        </div>
                        
                        <!-- Info Alert -->
                        <div class="col-12" id="stockInfoAlert">
                            <div class="alert alert-info d-flex align-items-center mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                <span id="stockInfo">Select a product to see current stock</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning" id="submitBtn">
                        <i class="fas fa-save me-2"></i>Process Stock Out
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Transaction Details Modal (same as stock‑in) -->
<div class="modal fade" id="transactionDetailsModal" tabindex="-1" aria-hidden="true" aria-labelledby="transactionDetailsModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="transactionDetailsModalLabel">
                    <i class="fas fa-info-circle me-2"></i>Transaction Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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

<!-- Hidden form for CSRF token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
        --info-gradient: linear-gradient(135deg, #5f2c82 0%, #49a09d 100%);
        --shadow-soft: 0 10px 30px -12px rgba(0, 0, 0, 0.15);
        --shadow-hover: 0 20px 40px -15px rgba(0, 0, 0, 0.25);
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Enhanced Header (warning theme) */
    .modern-header-enhanced {
        background: white;
        border-bottom: 2px solid #f59e0b;
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
        background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
        opacity: 0.03;
        border-radius: 50%;
        transform: rotate(25deg);
        pointer-events: none;
        z-index: 0;
    }

    .header-icon-enhanced {
        width: clamp(45px, 6vw, 55px);
        height: clamp(45px, 6vw, 55px);
        background: var(--warning-gradient);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: clamp(1.2rem, 3vw, 1.8rem);
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        animation: scaleIn 0.6s ease-out;
    }

    /* Stat Cards */
    .stat-card-modern {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        border: 1px solid rgba(245,158,11,0.1);
        transition: var(--transition-smooth);
        animation: fadeInUp 0.6s ease-out;
        max-width: 100%;
        overflow: hidden;
    }

    .stat-card-modern:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(245,158,11,0.15);
        border-color: #f59e0b;
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
    .stat-icon.bg-danger { background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%); }

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

    /* Filter Card */
    .filter-card-enhanced {
        animation: fadeInUp 0.6s ease-out 0.1s both;
        max-width: 100%;
    }

    .input-group-enhanced .form-control,
    .form-select-enhanced {
        border-radius: 10px;
        transition: var(--transition-smooth);
        border: 1px solid #e5e7eb;
    }

    .input-group-enhanced .form-control:focus,
    .form-select-enhanced:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }

    .btn-gradient-warning {
        background: var(--warning-gradient);
        border: none;
        color: white;
    }

    .btn-gradient-warning:hover:not(:disabled) {
        background: linear-gradient(135deg, #e68a00 0%, #dc2626 100%);
    }

    /* Table */
    .modern-table {
        animation: fadeInUp 0.6s ease-out 0.2s both;
        max-width: 100%;
    }

    .modern-table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom-width: 2px;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .modern-table tbody tr {
        transition: var(--transition-smooth);
        border-bottom: 1px solid #e5e7eb;
    }

    .modern-table tbody tr:hover {
        background-color: rgba(245, 158, 11, 0.03);
        box-shadow: inset 0 0 10px rgba(245, 158, 11, 0.05);
    }

    /* Product icon */
    .product-icon-wrapper {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .avatar-initials-xs {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.8rem;
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    /* Copy button */
    .btn-copy {
        background: none;
        border: none;
        color: #6c757d;
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        transition: all 0.2s;
    }

    .btn-copy:hover {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .btn-copy:focus-visible {
        outline: 2px solid #f59e0b;
        outline-offset: 2px;
    }

    /* Pagination */
    .pagination-modern .pagination {
        gap: 5px;
    }

    .pagination-modern .page-link {
        border: none;
        border-radius: 12px;
        padding: 0.5rem 1rem;
        color: #495057;
        background: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: var(--transition-smooth);
    }

    .pagination-modern .page-link:hover {
        background: #e9ecef;
        transform: translateY(-2px);
    }

    .pagination-modern .page-item.active .page-link {
        background: var(--warning-gradient);
        color: white;
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
    }

    /* Empty State */
    .empty-state {
        padding: 4rem 1rem;
        text-align: center;
        animation: fadeInUp 0.6s ease-out;
    }

    .empty-state i {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 1rem;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Animations */
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

    /* Responsive */
    @media (max-width: 768px) {
        .modern-table thead {
            display: none;
        }

        .modern-table tbody tr {
            display: block;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            margin-bottom: 1rem;
            padding: 1rem;
            background: white;
            box-shadow: var(--shadow-soft);
            animation: fadeInUp 0.4s ease-out;
        }

        .modern-table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: none;
            padding: 0.5rem 0;
        }

        .modern-table tbody td:before {
            content: attr(data-label);
            font-weight: 600;
            color: #6c757d;
            margin-right: 1rem;
            font-size: 0.875rem;
            min-width: 100px;
        }

        .modern-header-enhanced .d-flex:last-child {
            width: 100%;
            order: 3;
        }

        .modern-header-enhanced .btn {
            flex: 1;
        }

        .stat-card-modern {
            padding: 12px !important;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            font-size: 1.4rem;
        }

        .stat-value {
            font-size: 1.3rem !important;
        }

        .stat-label {
            font-size: 0.65rem !important;
        }

        .btn-group {
            width: 100%;
            justify-content: flex-end;
        }

        .btn-group .btn {
            padding: 0.4rem 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .btn i {
            margin-right: 0;
        }

        .modern-table tbody td:before {
            min-width: 80px;
            font-size: 0.8rem;
        }

        .badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.6rem;
        }
    }

    /* Accessibility */
    .btn:focus,
    .form-control:focus,
    .form-select:focus {
        outline: 2px solid #f59e0b;
        outline-offset: 2px;
    }

    /* Print Styles */
    @media print {
        .modern-header-enhanced,
        .filter-card-enhanced,
        .btn-group,
        .pagination-modern,
        .modal {
            display: none;
        }

        .modern-table {
            box-shadow: none;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    'use strict';

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ==================== INITIALIZATION ====================
    $(document).ready(function() {
        $('#productSelect').select2({
            dropdownParent: $('#newStockOutModal'),
            theme: 'default',
            placeholder: '-- Select Product --',
            width: '100%'
        });

        animateStatCards();
        animateTableRows();
    });

    // ==================== ANIMATIONS ====================
    function animateStatCards() {
        const cards = document.querySelectorAll('.stat-card-modern');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    function animateTableRows() {
        const rows = document.querySelectorAll('.transaction-row');
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';
            setTimeout(() => {
                row.style.transition = 'all 0.5s ease-out';
                row.style.opacity = '1';
                row.style.transform = 'translateX(0)';
            }, index * 50);
        });
    }

    // ==================== VALIDATION ====================
    function validatePerPage(select) {
        const validValues = [15, 25, 50, 100];
        const value = parseInt(select.value);
        
        if (!validValues.includes(value)) {
            select.value = 15;
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Selection',
                text: 'Please select a valid number of records per page.',
                confirmButtonColor: '#f59e0b'
            });
            return false;
        }
        
        document.getElementById('perPageForm').submit();
        return true;
    }

    function validateDateRange() {
        const dateFrom = document.getElementById('dateFromInput').value;
        const dateTo = document.getElementById('dateToInput').value;
        if (dateFrom && dateTo && new Date(dateFrom) > new Date(dateTo)) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Date Range',
                text: 'Start date must be before end date.',
                confirmButtonColor: '#f59e0b'
            });
            return false;
        }
        return true;
    }

    // ==================== PRODUCT SELECT HANDLER ====================
    $('#productSelect').on('change', function() {
        const selected = $(this).find('option:selected');
        const stock = selected.data('stock') || 0;
        const price = selected.data('price') || 0;
        
        $('#currentStockDisplay').val(stock);
        $('#unitPriceDisplay').val('₱' + price.toFixed(2));
        $('#availableStockHint').text('Available: ' + stock + ' units');
        $('#stockInfo').text(`Available stock: ${stock} units. Maximum deductible: ${stock}`);
        
        updateTotalValue();
        checkStock();
    });

    $('#quantity').on('input', function() {
        updateTotalValue();
        checkStock();
    });

    function updateTotalValue() {
        const quantity = parseFloat($('#quantity').val()) || 0;
        const priceText = $('#unitPriceDisplay').val().replace('₱', '');
        const price = parseFloat(priceText) || 0;
        const total = quantity * price;
        $('#totalValueDisplay').val('₱' + total.toFixed(2));
    }

    function checkStock() {
        const available = parseFloat($('#currentStockDisplay').val()) || 0;
        const requested = parseFloat($('#quantity').val()) || 0;
        
        if (requested > available) {
            $('#stockWarning').show();
            $('#stockInfoAlert').hide();
            $('#warningMessage').text(`Warning: Requested quantity (${requested}) exceeds available stock (${available})!`);
            $('#submitBtn').prop('disabled', true);
        } else {
            $('#stockWarning').hide();
            $('#stockInfoAlert').show();
            $('#submitBtn').prop('disabled', false);
        }
        
        if (requested === 0) {
            $('#submitBtn').prop('disabled', true);
        }
    }

    // ==================== FORM SUBMISSION ====================
    document.getElementById('stockOutForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Reset validation
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.invalid-feedback').forEach(el => el.innerHTML = '');
        
        const formData = new FormData(this);
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        
        // Loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
        
        Swal.fire({
            title: 'Processing...',
            text: 'Please wait',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        
        fetch('{{ route("admin.inventory.process-stock-out") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
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
                    bootstrap.Modal.getInstance(document.getElementById('newStockOutModal')).hide();
                    window.location.reload();
                });
            } else {
                if (data.errors) {
                    Object.keys(data.errors).forEach(key => {
                        const input = document.querySelector(`[name="${key}"]`);
                        if (input) {
                            input.classList.add('is-invalid');
                            const errorDiv = document.getElementById(`${key}Error`) || input.closest('.input-group')?.nextElementSibling;
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

    // ==================== VIEW DETAILS (ENHANCED) ====================
    window.viewDetails = function(id) {
        const modal = new bootstrap.Modal(document.getElementById('transactionDetailsModal'));
        const contentDiv = document.getElementById('transactionDetailsContent');
        
        contentDiv.innerHTML = `
            <div class="text-center py-3">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;
        modal.show();
        
        fetch(`/admin/inventory/transaction/${id}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const t = data.transaction;
                const date = new Date(t.created_at);
                const formattedDate = date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                const formattedTime = date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                
                let reasonColor = 'secondary';
                if (t.reason === 'sale') reasonColor = 'success';
                else if (t.reason === 'damage' || t.reason === 'expired') reasonColor = 'danger';
                else if (t.reason === 'adjustment') reasonColor = 'info';
                else if (t.reason === 'return') reasonColor = 'primary';
                
                contentDiv.innerHTML = `
                    <div class="details-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="detail-item" style="background: #f8f9fa; border-radius: 12px; padding: 1rem;">
                            <span class="detail-label" style="font-size: 0.7rem; text-transform: uppercase; color: #6c757d; display: block;">Transaction ID</span>
                            <span class="detail-value" style="font-size: 1.1rem; font-weight: 600;">#${t.id}</span>
                        </div>
                        <div class="detail-item" style="background: #f8f9fa; border-radius: 12px; padding: 1rem;">
                            <span class="detail-label" style="font-size: 0.7rem; text-transform: uppercase; color: #6c757d; display: block;">Date</span>
                            <span class="detail-value" style="font-size: 1.1rem; font-weight: 600;">${formattedDate}</span>
                        </div>
                        <div class="detail-item" style="background: #f8f9fa; border-radius: 12px; padding: 1rem;">
                            <span class="detail-label" style="font-size: 0.7rem; text-transform: uppercase; color: #6c757d; display: block;">Time</span>
                            <span class="detail-value" style="font-size: 1.1rem; font-weight: 600;">${formattedTime}</span>
                        </div>
                        <div class="detail-item" style="background: #f8f9fa; border-radius: 12px; padding: 1rem;">
                            <span class="detail-label" style="font-size: 0.7rem; text-transform: uppercase; color: #6c757d; display: block;">Product</span>
                            <span class="detail-value" style="font-size: 1.1rem; font-weight: 600;">${t.product?.product_name || 'N/A'}</span>
                            <small class="text-muted d-block">${t.product?.product_code || ''}</small>
                        </div>
                        <div class="detail-item" style="background: #f8f9fa; border-radius: 12px; padding: 1rem;">
                            <span class="detail-label" style="font-size: 0.7rem; text-transform: uppercase; color: #6c757d; display: block;">Quantity</span>
                            <span class="detail-value" style="font-size: 1.1rem; font-weight: 600;"><span class="badge bg-warning">-${t.quantity}</span></span>
                        </div>
                        <div class="detail-item" style="background: #f8f9fa; border-radius: 12px; padding: 1rem;">
                            <span class="detail-label" style="font-size: 0.7rem; text-transform: uppercase; color: #6c757d; display: block;">Reason</span>
                            <span class="detail-value" style="font-size: 1.1rem; font-weight: 600;"><span class="badge bg-${reasonColor}">${t.reason || 'N/A'}</span></span>
                        </div>
                        <div class="detail-item" style="background: #f8f9fa; border-radius: 12px; padding: 1rem;">
                            <span class="detail-label" style="font-size: 0.7rem; text-transform: uppercase; color: #6c757d; display: block;">Reference</span>
                            <span class="detail-value" style="font-size: 1.1rem; font-weight: 600;">${t.reference || '—'}</span>
                        </div>
                        <div class="detail-item" style="background: #f8f9fa; border-radius: 12px; padding: 1rem;">
                            <span class="detail-label" style="font-size: 0.7rem; text-transform: uppercase; color: #6c757d; display: block;">User</span>
                            <span class="detail-value" style="font-size: 1.1rem; font-weight: 600;">${t.user?.name || 'System'}</span>
                        </div>
                    </div>
                `;
            } else {
                contentDiv.innerHTML = '<p class="text-danger text-center">Failed to load details.</p>';
            }
        })
        .catch(() => {
            contentDiv.innerHTML = '<p class="text-danger text-center">Error loading details.</p>';
        });
    };

    // ==================== VOID TRANSACTION ====================
    window.voidTransaction = function(id, productName, quantity) {
        Swal.fire({
            title: 'Void Transaction?',
            html: `This will return <strong>${quantity}</strong> units of <strong>${productName || 'this product'}</strong> to inventory.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
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
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Voided!',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
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
    };

    // ==================== COPY TO CLIPBOARD ====================
    document.querySelectorAll('.btn-copy').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const text = this.getAttribute('data-clipboard-text');
            if (!text) return;
            navigator.clipboard.writeText(text).then(() => {
                const originalTitle = this.getAttribute('title') || 'Copy';
                this.setAttribute('title', 'Copied!');
                setTimeout(() => this.setAttribute('title', originalTitle), 1500);
            }).catch(() => {
                const textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                const originalTitle = this.getAttribute('title') || 'Copy';
                this.setAttribute('title', 'Copied!');
                setTimeout(() => this.setAttribute('title', originalTitle), 1500);
            });
        });
    });

    // ==================== FORM HANDLING ====================
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        if (filterForm) {
            filterForm.addEventListener('submit', function(e) {
                if (!validateDateRange()) {
                    e.preventDefault();
                }
            });
        }

        const applyFilterBtn = document.getElementById('applyFilterBtn');
        if (applyFilterBtn) {
            applyFilterBtn.addEventListener('click', function() {
                this.disabled = true;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i><span class="d-none d-sm-inline">Applying...</span>';
                setTimeout(() => {
                    this.disabled = false;
                    this.innerHTML = '<i class="fas fa-filter me-2"></i><span class="d-none d-sm-inline">Apply</span>';
                }, 1000);
            });
        }

        // Debounced search
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            let timeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    if (this.value.length >= 2 || this.value.length === 0) {
                        document.getElementById('applyFilterBtn')?.click();
                    }
                }, 500);
            });
        }

        // Reset modal on close
        $('#newStockOutModal').on('hidden.bs.modal', function() {
            $('#stockOutForm')[0].reset();
            $('#productSelect').val(null).trigger('change');
            $('#currentStockDisplay').val('0');
            $('#unitPriceDisplay').val('₱0.00');
            $('#totalValueDisplay').val('₱0.00');
            $('#availableStockHint').text('');
            $('#stockWarning').hide();
            $('#stockInfoAlert').show();
            $('#submitBtn').prop('disabled', false);
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').empty();
        });
    });

    // ==================== RESPONSIVE DATA LABELS ====================
    function setDataLabels() {
        if (window.innerWidth < 768) {
            const headers = ['Date & Time', 'Product', 'Quantity', 'Unit Price', 'Total Value', 'Reason', 'Reference', 'User', 'Actions'];
            document.querySelectorAll('.modern-table tbody tr').forEach(row => {
                row.querySelectorAll('td').forEach((cell, index) => {
                    if (headers[index]) cell.setAttribute('data-label', headers[index]);
                });
            });
        }
    }
    setDataLabels();
    window.addEventListener('resize', setDataLabels);
</script>
@endpush