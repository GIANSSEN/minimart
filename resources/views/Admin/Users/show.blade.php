@extends('layouts.admin')

@section('title', 'User Details - ' . $user->full_name)

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Premium Header Card -->
    <div class="card border-0 shadow-premium rounded-4 mb-4 overflow-hidden">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-dots mb-2">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile Details</li>
                        </ol>
                    </nav>
                    <h1 class="h2 fw-bold text-dark mb-0">User Profile</h1>
                </div>
                
                <div class="header-actions d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm-custom px-3" onclick="window.print()" data-bs-toggle="tooltip" title="Print this profile">
                        <i class="fas fa-print me-2"></i>Print
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm-custom px-3">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary-gradient btn-sm-custom px-3">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </a>
                    <button type="button" class="btn btn-danger-soft btn-sm-custom px-3" onclick="showDeleteModal()">
                        <i class="fas fa-trash-alt me-2"></i>Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Sidebar: User Summary -->
        <div class="col-xl-4 col-lg-5">
            <!-- Profile Overview Card -->
            <div class="card border-0 shadow-premium rounded-4 mb-4 overflow-hidden">
                <div class="profile-card-banner"></div>
                <div class="card-body text-center pt-0">
                    <div class="profile-avatar-wrapper">
                        <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->full_name).'&background=6366f1&color=fff&size=200' }}" 
                             class="profile-avatar-large shadow-lg" alt="{{ $user->full_name }}">
                        <span class="status-indicator {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }}" 
                              data-bs-toggle="tooltip" title="{{ ucfirst($user->status) }}"></span>
                    </div>
                    
                    <h3 class="fw-bold text-dark mb-1">{{ $user->full_name }}</h3>
                    <p class="text-muted mb-3">@ {{ $user->username }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge-premium badge-role">
                            <i class="fas fa-shield-alt me-1"></i> {{ $user->role_label }}
                        </span>
                        <span class="badge-premium {{ $user->isApproved() ? 'badge-success' : ($user->isRejected() ? 'badge-danger' : 'badge-warning') }}">
                            <i class="fas {{ $user->isApproved() ? 'fa-check-circle' : ($user->isRejected() ? 'fa-times-circle' : 'fa-clock') }} me-1"></i>
                            {{ ucfirst($user->approval_status ?? 'Approved') }}
                        </span>
                    </div>

                    <div class="profile-stats-grid">
                        <div class="stat-item">
                            <span class="stat-value">{{ $user->created_at->format('M Y') }}</span>
                            <span class="stat-label">Joined</span>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-item">
                            <span class="stat-value">{{ $user->employee_id ?? 'N/A' }}</span>
                            <span class="stat-label">Emp ID</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact & Quick Info -->
            <div class="card border-0 shadow-premium rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <span class="icon-box-small me-3"><i class="fas fa-address-book"></i></span>
                        Contact Information
                    </h5>
                    
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <label class="text-muted small fw-semibold d-block mb-1">Email Address</label>
                            <div class="d-flex align-items-center justify-content-between profile-info-item p-2 rounded-3">
                                <span class="text-dark fw-medium text-truncate me-2">{{ $user->email }}</span>
                                <button class="btn btn-icon-copy" onclick="copyToClipboard('{{ $user->email }}', 'Email copied!')" title="Copy Email">
                                    <i class="far fa-copy text-primary"></i>
                                </button>
                            </div>
                        </li>
                        <li class="mb-3">
                            <label class="text-muted small fw-semibold d-block mb-1">Phone Number</label>
                            <div class="d-flex align-items-center profile-info-item p-2 rounded-3">
                                <span class="text-dark fw-medium">{{ $user->phone ?? 'Not provided' }}</span>
                            </div>
                        </li>
                        <li>
                            <label class="text-muted small fw-semibold d-block mb-1">Primary Address</label>
                            <div class="d-flex align-items-center profile-info-item p-2 rounded-3">
                                <span class="text-dark fw-medium">{{ $user->address ?? 'No address listed' }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Metadata Card -->
            <div class="card border-0 shadow-premium rounded-4 bg-light-soft">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">System UUID:</span>
                        <code class="small text-primary">#{{ $user->id }}</code>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Last Modified:</span>
                        <span class="small text-dark">{{ $user->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Record Created:</span>
                        <span class="small text-dark">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content: Details & Timeline -->
        <div class="col-xl-8 col-lg-7">
            <!-- Account Details Accordion/Section -->
            <div class="card border-0 shadow-premium rounded-4 mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <ul class="nav nav-pills-premium" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-overview-tab" data-bs-toggle="pill" data-bs-target="#pills-overview" type="button" role="tab">
                                <i class="fas fa-id-card me-2"></i>Overview
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-history-tab" data-bs-toggle="pill" data-bs-target="#pills-history" type="button" role="tab">
                                <i class="fas fa-history me-2"></i>History
                            </button>
                        </li>
                    </ul>
                </div>
                
                <div class="card-body p-4">
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Overview Tab -->
                        <div class="tab-pane fade show active" id="pills-overview" role="tabpanel">
                            <div class="row g-4">
                                <!-- Personal Info Grid -->
                                <div class="col-12 mb-2">
                                    <h6 class="text-uppercase text-primary fw-bold small ls-wide mb-3">Account Information</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="data-card p-3 rounded-4">
                                                <span class="d-block text-muted small mb-1">Full Identity</span>
                                                <span class="h6 fw-bold mb-0">{{ $user->full_name }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="data-card p-3 rounded-4">
                                                <span class="d-block text-muted small mb-1">Access Credentials</span>
                                                <span class="h6 fw-bold mb-0">Username: {{ $user->username }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="data-card p-3 rounded-4">
                                                <span class="d-block text-muted small mb-1">Designation</span>
                                                <span class="h6 fw-bold mb-0 text-primary">{{ $user->role_label }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="data-card p-3 rounded-4">
                                                <span class="d-block text-muted small mb-1">Last Login</span>
                                                <span class="h6 fw-bold mb-0 {{ $user->last_login ? 'text-dark' : 'text-muted italic' }}">
                                                    {{ $user->last_login ? $user->last_login->format('M d, Y h:i A') : 'No login recorded' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="data-card p-3 rounded-4">
                                                <span class="d-block text-muted small mb-1">Corporate ID</span>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="h6 fw-bold mb-0">{{ $user->employee_id ?? 'P-000000' }}</span>
                                                    @if($user->employee_id)
                                                    <button class="btn btn-sm p-0 border-0" onclick="copyToClipboard('{{ $user->employee_id }}', 'ID copied!')" data-bs-toggle="tooltip" title="Copy to clipboard">
                                                        <i class="far fa-copy text-muted small"></i>
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Security & Permissions -->
                                <div class="col-12 mt-4">
                                    <h6 class="text-uppercase text-primary fw-bold small ls-wide mb-3">Security & Permissions</h6>
                                    <div class="data-card p-4 rounded-4 border-start-highlight">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="permission-icon me-3">
                                                <i class="fas fa-lock text-primary"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-bold">Roles & Privileges</p>
                                                <p class="text-muted small mb-0">Inherited permissions based on role settings.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2">
                                            @forelse($user->roles as $role)
                                                <span class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill fw-medium">
                                                    <i class="fas fa-check-circle me-1"></i> {{ $role->name }}
                                                </span>
                                            @empty
                                                <span class="badge bg-secondary-soft text-secondary px-3 py-2 rounded-pill fw-medium">
                                                    No explicit roles assigned
                                                </span>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Admin Actions/Shortcuts -->
                                <div class="col-12 mt-4">
                                    <div class="quick-action-strip p-3 rounded-4 d-flex flex-wrap gap-3 align-items-center justify-content-between bg-light">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-bolt text-warning"></i>
                                            <span class="fw-bold text-dark small">Quick Actions:</span>
                                        </div>
                                        <div class="d-flex gap-2">
                                            @if($user->status === 'active')
                                                <button class="btn btn-white btn-sm px-3 shadow-xs border" onclick="toggleStatus({{ $user->id }}, 'inactive')">Deactivate</button>
                                            @else
                                                <button class="btn btn-white btn-sm px-3 shadow-xs border" onclick="toggleStatus({{ $user->id }}, 'active')">Activate</button>
                                            @endif
                                            <button class="btn btn-white btn-sm px-3 shadow-xs border">Reset Password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- History Tab -->
                        <div class="tab-pane fade" id="pills-history" role="tabpanel">
                            <div class="timeline-premium">
                                <!-- Created -->
                                <div class="timeline-step">
                                    <div class="timeline-icon bg-primary-soft text-primary">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="timeline-info">
                                        <span class="timeline-time">{{ $user->created_at->diffForHumans() }}</span>
                                        <h6 class="fw-bold text-dark mb-1">Account Created</h6>
                                        <p class="text-muted small mb-0">System initialized user account records.</p>
                                        <div class="mt-2 text-dark font-monospace small bg-light p-2 rounded">
                                            ID: {{ $user->id }} | Reg Date: {{ $user->created_at->format('D, M d, Y') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Approval Status -->
                                <div class="timeline-step">
                                    <div class="timeline-icon {{ $user->isApproved() ? 'bg-success-soft text-success' : ($user->isRejected() ? 'bg-danger-soft text-danger' : 'bg-warning-soft text-warning') }}">
                                        <i class="fas {{ $user->isApproved() ? 'fa-check' : ($user->isRejected() ? 'fa-times' : 'fa-clock') }}"></i>
                                    </div>
                                    <div class="timeline-info">
                                        <span class="timeline-time">Current State</span>
                                        <h6 class="fw-bold text-dark mb-1">Verification Status: {{ ucfirst($user->approval_status ?? 'Pending') }}</h6>
                                        @if($user->isRejected())
                                            <p class="text-danger small mb-1 font-italic">Reason: {{ $user->rejection_reason ?? 'No reason provided' }}</p>
                                        @endif
                                        <p class="text-muted small mb-0">Account verification level maintained by administrators.</p>
                                    </div>
                                </div>

                                <!-- Last Modification -->
                                <div class="timeline-step last">
                                    <div class="timeline-icon bg-info-soft text-info">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <div class="timeline-info">
                                        <span class="timeline-time">{{ $user->updated_at->diffForHumans() }}</span>
                                        <h6 class="fw-bold text-dark mb-1">Last synchronized update</h6>
                                        <p class="text-muted small mb-0">Metadata and profile configuration was last refreshed.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Delete Confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-body p-5 text-center">
                <div class="mb-4">
                    <div class="icon-circle-large bg-danger-soft text-danger mx-auto">
                        <i class="fas fa-trash-alt fa-2x"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark mb-3">Permanent Deletion</h4>
                <p class="text-muted mb-4">You are about to remove <strong>{{ $user->full_name }}</strong> from the system. This action will purge all associated activity logs and cannot be reversed.</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light px-4 py-2" data-bs-dismiss="modal">Keep Record</button>
                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger-gradient px-4 py-2">Delete Permanently</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast for copy notification -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="copyToast" class="toast align-items-center text-white bg-dark border-0 rounded-pill shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body px-4 py-2">
                <i class="fas fa-check-circle text-success me-2"></i> <span id="toastMessage">Copied to clipboard!</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Premium UI Colors & Variables */
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        --danger-gradient: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
        --success-soft: rgba(16, 185, 129, 0.1);
        --danger-soft: rgba(239, 68, 68, 0.1);
        --primary-soft: rgba(99, 102, 241, 0.1);
        --warning-soft: rgba(245, 158, 11, 0.1);
        --info-soft: rgba(6, 182, 212, 0.1);
        --shadow-premium: 0 10px 30px -5px rgba(0, 0, 0, 0.05), 0 5px 15px -5px rgba(0, 0, 0, 0.04);
        --ls-wide: 0.05em;
    }

    /* Layout & Base */
    .bg-light-soft { background-color: #f9fafb !important; }
    .btn-sm-custom { font-size: 0.875rem; font-weight: 600; border-radius: 10px; padding: 0.6rem 1.25rem; }
    .ls-wide { letter-spacing: var(--ls-wide); }

    /* Header Styling */
    .breadcrumb-dots .breadcrumb-item + .breadcrumb-item::before { content: "•"; color: #9ca3af; padding-right: 0.5rem; }
    .breadcrumb-item a { color: #6b7280; text-decoration: none; transition: color 0.2s; }
    .breadcrumb-item a:hover { color: #6366f1; }

    /* Buttons */
    .btn-primary-gradient { background: var(--primary-gradient); color: white; border: none; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3); }
    .btn-primary-gradient:hover { background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); color: white; transform: translateY(-1px); }
    .btn-danger-gradient { background: var(--danger-gradient); color: white; border: none; }
    .btn-danger-soft { background-color: var(--danger-soft); color: #dc2626; border: none; }
    .btn-danger-soft:hover { background-color: #dc2626; color: white; }
    .btn-white { background: white; border: 1px solid #e5e7eb; color: #374151; font-weight: 600; }
    .btn-white:hover { background: #f9fafb; border-color: #d1d5db; }

    /* Profile Card */
    .profile-card-banner { height: 160px; background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); position: relative; }
    .profile-avatar-wrapper { position: relative; width: 140px; height: 140px; margin: -70px auto 3rem; z-index: 10; transition: transform 0.3s ease; }
    .profile-avatar-wrapper:hover { transform: scale(1.05); }
    .profile-avatar-large { width: 140px; height: 140px; border: 8px solid white; border-radius: 42px; object-fit: cover; background: #fff; box-shadow: 0 15px 35px rgba(0,0,0,0.2); }
    .status-indicator { position: absolute; bottom: 12px; right: 12px; width: 24px; height: 24px; border-radius: 50%; border: 4px solid white; z-index: 11; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }

    /* Badges */
    .badge-premium { padding: 0.5rem 1rem; border-radius: 12px; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; display: inline-flex; align-items: center; }
    .badge-role { background-color: #f3f4f6; color: #374151; }
    .badge-success { background-color: var(--success-soft); color: #059669; }
    .badge-danger { background-color: var(--danger-soft); color: #dc2626; }
    .badge-warning { background-color: var(--warning-soft); color: #d97706; }

    /* Stats Grid */
    .profile-stats-grid { display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; padding: 1.5rem; background: #f9fafb; border-radius: 20px; margin: 0 1.5rem 1.5rem; }
    .stat-item { flex: 1; text-align: center; }
    .stat-value { display: block; font-weight: 800; color: #111827; font-size: 1rem; }
    .stat-label { display: block; font-size: 0.75rem; color: #6b7280; font-weight: 600; text-transform: uppercase; }
    .stat-divider { width: 1px; height: 40px; background: #e5e7eb; }

    /* Info Items */
    .icon-box-small { width: 36px; height: 36px; border-radius: 10px; background: var(--primary-soft); color: #6366f1; display: flex; align-items: center; justify-content: center; }
    .profile-info-item { background: #f9fafb; border: 1px solid transparent; transition: all 0.2s; }
    .profile-info-item:hover { background: #fff; border-color: #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .btn-icon-copy { width: 32px; height: 32px; border-radius: 8px; border: none; background: transparent; transition: background 0.2s; display: flex; align-items: center; justify-content: center; }
    .btn-icon-copy:hover { background: var(--primary-soft); }

    /* Nav Pills */
    .nav-pills-premium .nav-link { color: #6b7280; font-weight: 600; border-radius: 12px; padding: 0.75rem 1.5rem; transition: all 0.3s; border: 1px solid transparent; margin-right: 0.5rem; }
    .nav-pills-premium .nav-link.active { background: white; color: #6366f1; border-color: #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .nav-pills-premium .nav-link:hover:not(.active) { background: #f3f4f6; color: #111827; }

    /* Details Grid */
    .data-card { background: #f9fafb; border: 1px solid #f3f4f6; transition: all 0.3s; }
    .data-card:hover { background: white; border-color: #e5e7eb; transform: translateY(-2px); box-shadow: 0 10px 20px -5px rgba(0,0,0,0.03); }
    .border-start-highlight { border-left: 4px solid #6366f1; }
    .bg-primary-soft { background-color: var(--primary-soft) !important; }
    .bg-secondary-soft { background-color: #f3f4f6 !important; }

    /* Timeline Premium */
    .timeline-premium { position: relative; padding-left: 3rem; margin-top: 1rem; }
    .timeline-premium::before { content: ""; position: absolute; left: 1rem; top: 0; bottom: 0; width: 2px; background: #e5e7eb; }
    .timeline-step { position: relative; margin-bottom: 2.5rem; }
    .timeline-icon { position: absolute; left: -2.75rem; width: 2.5rem; height: 2.5rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 1; border: 4px solid white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .timeline-info { background: #fff; padding: 1.25rem; border-radius: 20px; border: 1px solid #f3f4f6; position: relative; }
    .timeline-info::before { content: ""; position: absolute; left: -10px; top: 15px; width: 20px; height: 20px; background: white; transform: rotate(45deg); border-left: 1px solid #f3f4f6; border-bottom: 1px solid #f3f4f6; }
    .timeline-time { display: block; font-size: 0.75rem; font-weight: 700; color: #6366f1; text-transform: uppercase; margin-bottom: 0.25rem; }
    
    /* Utility */
    .icon-circle-large { width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
    .shadow-xs { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
    .toast { min-width: 250px; }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });

    // Copy to clipboard function
    function copyToClipboard(text, message) {
        navigator.clipboard.writeText(text).then(() => {
            const toastEl = document.getElementById('copyToast');
            document.getElementById('toastMessage').innerText = message;
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }

    // Modal helpers
    function showDeleteModal() {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    // Simplified toggle status via AJAX
    function toggleStatus(userId, status) {
        if (!confirm(`Are you sure you want to ${status === 'active' ? 'activate' : 'deactivate'} this user?`)) return;
        
        fetch(`/admin/users/${userId}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.error || 'Failed to update status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong');
        });
    }
</script>
@endpush
