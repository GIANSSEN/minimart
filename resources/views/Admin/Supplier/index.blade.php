@extends('layouts.admin')

@section('title', 'Suppliers - CJ\'s Minimart')

@push('styles')
<style>
/* Modern Minimalist Suppliers Page */
.suppliers-page {
    padding: clamp(0.75rem, 2vw, 1.5rem);
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1.25rem;
    margin-bottom: 1.5rem;
}

.stat-card-premium {
    background: #fff;
    border-radius: 20px;
    padding: 1.5rem;
    border: 1px solid #edf2f7;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.02);
}

.stat-card-premium:hover {
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    border-color: #e2e8f0;
}

.stat-icon-wrapper {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-info .stat-value {
    display: block;
    font-size: 1.5rem;
    font-weight: 800;
    color: #1e293b;
    line-height: 1.2;
}

.stat-info .stat-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

/* Filter Card */
.filter-card-premium {
    background: #fff;
    border-radius: 20px;
    border: 1px solid #edf2f7;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.02);
}

.search-input-group {
    background: #f8fafc;
    border-radius: 12px;
    padding: 0.5rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    border: 1px solid #e2e8f0;
    transition: all 0.2s;
}

.search-input-group:focus-within {
    background: #fff;
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

.search-input-group input {
    background: transparent;
    border: none;
    outline: none;
    width: 100%;
    font-size: 0.95rem;
    color: #1e293b;
}

.filter-select {
    padding: 0.75rem 1rem;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    font-size: 0.95rem;
    color: #1e293b;
    outline: none;
    transition: all 0.2s;
}

.filter-select:focus {
    border-color: #3b82f6;
    background: #fff;
}

/* Table Enhancements */
.content-card-premium {
    background: #fff;
    border-radius: 24px;
    border: 1px solid #edf2f7;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}

.premium-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.premium-table thead th {
    background: #f8fafc;
    padding: 1.25rem 1.5rem;
    font-size: 0.75rem;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.premium-table tbody tr:hover {
    background: #f8fafc;
}

.premium-table td {
    padding: 1.25rem 1.5rem;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
}

.supplier-identity {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.supplier-icon-box {
    width: 44px;
    height: 44px;
    background: #eff6ff;
    color: #3b82f6;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.supplier-name {
    display: block;
    font-weight: 700;
    color: #1e293b;
    font-size: 0.95rem;
}

.supplier-code-badge {
    display: inline-block;
    padding: 0.15rem 0.5rem;
    background: #f1f5f9;
    color: #64748b;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    font-family: monospace;
}

.status-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}

.status-active { background: #ecfdf5; color: #10b981; }
.status-inactive { background: #f1f5f9; color: #94a3b8; }

/* Modal Premium Styling */
.modal-premium .modal-content {
    border: none;
    border-radius: 24px;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15);
}

.modal-premium .modal-header {
    background: #fff;
    border-bottom: 1px solid #f1f5f9;
    padding: 1.5rem 2rem;
    border-radius: 24px 24px 0 0;
}

.modal-premium .modal-title {
    font-weight: 800;
    color: #1e293b;
}

.modal-premium .modal-body {
    padding: 2rem;
}

.modal-premium .modal-footer {
    border-top: 1px solid #f1f5f9;
    padding: 1.25rem 2rem;
    border-radius: 0 0 24px 24px;
}
</style>
@endpush

@section('content')
<div class="suppliers-page">
    {{-- Premium Header --}}
    <div class="page-header-premium">
        <div class="header-left">
            <div class="header-icon-box" style="background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%);">
                <i class="fas fa-truck"></i>
            </div>
            <div class="header-text">
                <h1 class="page-title">Suppliers</h1>
                <p class="page-subtitle">Manage inventory partners and procurement sources</p>
            </div>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.purchase-history.index') }}" class="btn-header-action btn-header-light">
                <i class="fas fa-history"></i>
                <span>History</span>
            </a>
            <a href="{{ route('admin.suppliers.create') }}" class="btn-header-action btn-header-primary">
                <i class="fas fa-plus-circle"></i>
                <span>Register Supplier</span>
            </a>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="stats-grid">
        <div class="stat-card-premium">
            <div class="stat-icon-wrapper" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ number_format($suppliers->total()) }}</span>
                <span class="stat-label">Registered</span>
            </div>
        </div>
        <div class="stat-card-premium">
            <div class="stat-icon-wrapper" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                <i class="fas fa-check-shield"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ number_format($activeCount) }}</span>
                <span class="stat-label">Active Partners</span>
            </div>
        </div>
        <div class="stat-card-premium">
            <div class="stat-icon-wrapper" style="background: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ number_format($totalProducts) }}</span>
                <span class="stat-label">Unique Products</span>
            </div>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="filter-card-premium">
        <form method="GET" action="{{ route('admin.suppliers.index') }}" class="row g-3">
            <div class="col-lg-7 col-md-12">
                <div class="search-input-group">
                    <i class="fas fa-search text-muted"></i>
                    <input type="text" name="search" placeholder="Search by name, code, contact person..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <select name="status" class="filter-select w-100" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active Only</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive Only</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6">
                <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-bold" style="background: #3b82f6; border: none;">
                    <i class="fas fa-filter me-2"></i>Filter Results
                </button>
            </div>
        </form>
    </div>

    {{-- Main Content --}}
    <div class="content-card-premium">
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th class="ps-4">Supplier Identity</th>
                        <th>Primary Contact</th>
                        <th>Location</th>
                        <th>Catalog</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(is_countable($suppliers) ? count($suppliers) > 0 : !empty($suppliers))
@foreach($suppliers as $supplier)
                    <tr>
                        <td class="ps-4">
                            <div class="supplier-identity">
                                <div class="supplier-icon-box">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div>
                                    <span class="supplier-name">{{ $supplier->supplier_name }}</span>
                                    <span class="supplier-code-badge">{{ $supplier->supplier_code }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $supplier->contact_person ?? 'No Representative' }}</span>
                                <span class="text-muted small">{{ $supplier->email ?? $supplier->phone ?? 'No contact info' }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="text-muted small d-inline-block text-truncate" style="max-width: 150px;">
                                {{ $supplier->address ?? 'No address set' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-blue-soft text-primary fw-bold" style="font-size: 0.75rem;">
                                {{ $supplier->products_count }} Skus
                            </span>
                        </td>
                        <td>
                            @if ($supplier->status == 'active')
                                <div class="status-badge status-active">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Active</span>
                                </div>
                            @else
                                <div class="status-badge status-inactive">
                                    <i class="fas fa-minus-circle"></i>
                                    <span>Inactive</span>
                                </div>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <button onclick="showSupplier({{ $supplier->id }})" class="btn-view" title="View Catalog">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editSupplier({{ $supplier->id }})" class="btn-edit" title="Edit Partner">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteSupplier({{ $supplier->id }}, '{{ addslashes($supplier->supplier_name) }}')" class="btn-del" title="Terminate Partnership">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
@else
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted">No suppliers found.</div>
                        </td>
                    </tr>
@endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Show Supplier Modal --}}
<div class="modal fade modal-premium" id="supplierShowModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div id="supplierShowContent">
                <!-- Content injected via JS -->
            </div>
            <div class="modal-footer bg-light border-0 py-3">
                <button type="button" class="btn btn-secondary rounded-pill fw-bold px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Edit Supplier Modal --}}
<div class="modal fade modal-premium" id="supplierEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSupplierForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold small text-muted text-uppercase">Supplier Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_supplier_name" name="supplier_name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Contact Person</label>
                            <input type="text" class="form-control" id="edit_contact_person" name="contact_person">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Phone</label>
                            <input type="text" class="form-control" id="edit_phone" name="phone">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Status</label>
                            <select class="form-select" id="edit_status" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold small text-muted text-uppercase">Address</label>
                            <input type="text" class="form-control" id="edit_address" name="address">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill fw-bold px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill fw-bold px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    // ==================== SHOW SUPPLIER ====================
    window.showSupplier = async function(id) {
        // Modal logic
        const modalElement = document.getElementById('supplierShowModal');
        if (!modalElement) return;
        const modal = new bootstrap.Modal(modalElement);
        const content = document.getElementById('supplierShowContent');
        
        content.innerHTML = `<div class="p-5 text-center"><div class="spinner-border text-primary" role="status"></div></div>`;
        modal.show();
        
        try {
            const response = await fetch(`/admin/suppliers/${id}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (!response.ok) throw new Error('Failed to fetch details');
            const supplier = await response.json();
            
            content.innerHTML = `
                <div class="modal-header border-0 pb-0 pe-4 pt-4">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="px-5 pb-5">
                    <div class="text-center mb-5">
                        <div class="mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 100px; height: 100px;">
                                <i class="fas fa-building fa-3x text-primary"></i>
                            </div>
                        </div>
                        <h2 class="fw-bolder mb-1 text-dark">${supplier.supplier_name}</h2>
                        <div class="d-flex justify-content-center gap-2 align-items-center">
                            <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-bold">${supplier.supplier_code}</span>
                            ${supplier.status === 'active' 
                                ? '<span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold"><i class="fas fa-check-circle me-1"></i>Active</span>' 
                                : '<span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-bold"><i class="fas fa-minus-circle me-1"></i>Inactive</span>'}
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 rounded-4 border bg-light bg-opacity-50 h-100">
                                <label class="small fw-bold text-muted text-uppercase d-block mb-2 font-monospace" style="letter-spacing: 1px;">Primary Contact</label>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-white rounded-3 shadow-sm p-2">
                                        <i class="fas fa-user-tie text-primary"></i>
                                    </div>
                                    <span class="text-dark fw-bold fs-5">${supplier.contact_person || 'Not Assigned'}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-4 border bg-light bg-opacity-50 h-100">
                                <label class="small fw-bold text-muted text-uppercase d-block mb-2 font-monospace" style="letter-spacing: 1px;">Communication</label>
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-envelope text-muted small"></i>
                                        <span class="text-dark small fw-medium">${supplier.email || 'No Email'}</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-phone text-muted small"></i>
                                        <span class="text-dark small fw-medium">${supplier.phone || 'No Phone'}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-4 rounded-4 border bg-white shadow-sm">
                                <label class="small fw-bold text-muted text-uppercase d-block mb-3 font-monospace" style="letter-spacing: 1px;">Address & Location</label>
                                <div class="d-flex gap-3">
                                    <div class="bg-light rounded-3 p-3 flex-shrink-0">
                                        <i class="fas fa-map-marked-alt text-primary fs-4"></i>
                                    </div>
                                    <p class="mb-0 text-dark fw-medium lh-base pt-1">${supplier.address || 'No full address registered for this partner.'}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        } catch (error) {
            content.innerHTML = `<div class="p-5 text-center text-danger"><i class="fas fa-exclamation-circle me-2"></i> Error loading details.</div>`;
        }
    };

    // ==================== EDIT SUPPLIER ====================
    window.editSupplier = async function(id) {
        const modalElement = document.getElementById('supplierEditModal');
        if (!modalElement) return;
        const modal = new bootstrap.Modal(modalElement);
        const form = document.getElementById('editSupplierForm');
        
        form.reset();
        
        Swal.fire({
            title: 'Loading...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        
        try {
            const response = await fetch(`/admin/suppliers/${id}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (!response.ok) throw new Error('Failed to fetch data');
            const supplier = await response.json();
            
            document.getElementById('editSupplierForm').action = `/admin/suppliers/${id}`;
            document.getElementById('edit_supplier_name').value = supplier.supplier_name;
            document.getElementById('edit_contact_person').value = supplier.contact_person || '';
            document.getElementById('edit_email').value = supplier.email || '';
            document.getElementById('edit_phone').value = supplier.phone || '';
            document.getElementById('edit_address').value = supplier.address || '';
            document.getElementById('edit_status').value = supplier.status || 'active';
            
            Swal.close();
            modal.show();
            
        } catch (error) {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Could not load supplier data.' });
        }
    };

    // ==================== DELETE SUPPLIER ====================
    window.deleteSupplier = function(id, name) {
        Swal.fire({
            title: 'Delete Supplier?',
            text: `Are you sure you want to delete ${name}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Cancel'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(`/admin/suppliers/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    
                    const data = await response.json();
                    if (data.success || response.ok) {
                        Swal.fire('Deleted!', 'Supplier deleted successfully.', 'success').then(() => window.location.reload());
                    } else {
                        throw new Error(data.message || 'Delete failed');
                    }
                } catch (error) {
                    Swal.fire({ icon: 'error', title: 'Error', text: error.message });
                }
            }
        });
    };
</script>
@endpush
