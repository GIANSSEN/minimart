import sys
import codecs

file_path = r'c:\xampplatest\htdocs\Minimart - sample\resources\views\Admin\Inventory\stock-in.blade.php'
with codecs.open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

start_marker = "<!-- Bulk Stock In Modal -->"
end_marker = "<!-- Transaction Details Modal -->"

start_idx = content.find(start_marker)
end_idx = content.find(end_marker)

if start_idx != -1 and end_idx != -1:
    new_modal = """<!-- Bulk Stock In Modal -->
<div class="modal fade" id="bulkStockInModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
            <div class="modal-header border-0 p-4" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">
                <div class="d-flex align-items-center flex-grow-1">
                    <div>
                        <h5 class="modal-title fw-bold mb-0">Record Bulk Stock In</h5>
                        <p class="small mb-0 opacity-75">Receive products in bulk packages (Dozen, Box, etc.)</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="bulkStockInForm" method="POST" action="{{ route('admin.inventory.process-stock-in') }}">
                @csrf
                <input type="hidden" name="type" value="in">
                <!-- Real computed values for the backend -->
                <input type="hidden" name="quantity" id="bulkComputedQuantity" value="0">
                <input type="hidden" name="unit_cost" id="bulkComputedUnitCost" value="0">
                
                <div class="modal-body p-4 bg-white">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="show-modal-section-label" style="color: #d97706;">
                                <i class="fas fa-info me-1"></i> Transaction Info
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="bulkSupplierSelect">Supplier <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-truck text-muted"></i></span>
                                <select name="supplier_id" class="form-select select2 border-start-0" id="bulkSupplierSelect" required>
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="bulkReceivedDate">Received Date <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="far fa-calendar-alt text-muted"></i></span>
                                <input type="date" name="received_date" class="form-control border-start-0" id="bulkReceivedDate" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="bulkReceivedBy">Received By <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="far fa-user text-muted"></i></span>
                                <input type="text" name="received_by" class="form-control border-start-0" id="bulkReceivedBy" value="{{ auth()->user()->name }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="show-modal-section-label" style="color: #d97706;">
                                <i class="fas fa-search me-1"></i> Product Selection
                            </div>
                        </div>
        
                        <div class="col-12">
                            <div class="p-3 rounded-4 border bg-light bg-opacity-50">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="bulkProductSelect">Select Product <span class="text-danger">*</span></label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-white border-end-0 px-3">
                                                <i class="fas fa-box text-warning"></i>
                                            </span>
                                            <select name="product_id" class="form-select select2 border-start-0" id="bulkProductSelect" required disabled>
                                                <option value="">-- Choose Supplier First --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="show-modal-section-label" style="color: #d97706;">
                                <i class="fas fa-boxes me-1"></i> Bulk Packaging Details
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="bulkPackageType">Package Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="bulkPackageType" required>
                                <option value="Dozen">Dozen</option>
                                <option value="Box">Box</option>
                                <option value="Case">Case</option>
                                <option value="Crate">Crate</option>
                                <option value="Pallet">Pallet</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="bulkItemsPerPackage">Items per Pkg <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="bulkItemsPerPackage" value="12" min="1" step="0.01" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="bulkNumPackages">No. of Pkgs <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="bulkNumPackages" value="1" min="0.01" step="0.01" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="bulkCostPerPackage">Cost per Pkg <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="bulkCostPerPackage" value="0.00" min="0" step="0.01" required>
                        </div>

                        <div class="col-12">
                            <div class="p-3 bg-warning bg-opacity-10 rounded-4 border border-warning border-opacity-25 mt-2">
                                <div class="row text-center">
                                    <div class="col-md-4 border-end border-warning border-opacity-25">
                                        <label class="form-label fw-bold small text-warning text-uppercase mb-1">Total Units to Receive</label>
                                        <div class="fs-4 fw-bold text-dark" id="bulkSummaryTotalUnits">12 units</div>
                                    </div>
                                    <div class="col-md-4 border-end border-warning border-opacity-25">
                                        <label class="form-label fw-bold small text-warning text-uppercase mb-1">Computed Unit Cost</label>
                                        <div class="fs-4 fw-bold text-dark" id="bulkSummaryUnitCost">₱ 0.00</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold small text-primary text-uppercase mb-1">Total Transaction Cost</label>
                                        <div class="fs-3 fw-bold text-primary" id="bulkSummaryTotalCost">₱ 0.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-secondary bg-opacity-10 rounded-4 border border-secondary border-opacity-25 shadow-sm">
                                <label class="form-label fw-bold small text-secondary text-uppercase mb-1">Current Inventory Level</label>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-warehouse text-secondary opacity-50"></i>
                                    <div class="fs-4 fw-bold text-secondary" id="bulkFinalCurrentStock">0 units</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1">Movement Type</label>
                            <div class="stock-type-group d-flex flex-wrap gap-2 mt-1">
                                <input type="radio" class="btn-check" name="reason" id="bulkTypeNew" value="purchase" checked>
                                <label class="btn btn-outline-success btn-sm rounded-pill px-3" for="bulkTypeNew">Purchase</label>

                                <input type="radio" class="btn-check" name="reason" id="bulkTypeReturn" value="return">
                                <label class="btn btn-outline-warning btn-sm rounded-pill px-3" for="bulkTypeReturn">Return</label>

                                <input type="radio" class="btn-check" name="reason" id="bulkTypeAdj" value="adjustment">
                                <label class="btn btn-outline-info btn-sm rounded-pill px-3" for="bulkTypeAdj">Adjustment</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="show-modal-section-label" style="color: #d97706;">
                                <i class="fas fa-file-alt me-1"></i> Additional Details
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="bulkReference">PO Number</label>
                            <input type="text" name="reference" class="form-control" id="bulkReference" placeholder="e.g. PO-2024-001">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="bulkLocation">Location</label>
                            <input type="text" name="location" class="form-control" id="bulkLocation" placeholder="e.g. Warehouse A">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-1" for="bulkNotes">Notes</label>
                            <input type="hidden" name="notes" id="bulkFormNotes">
                            <textarea class="form-control" id="bulkDisplayNotes" rows="2" readonly></textarea>
                            <small class="text-muted">Auto-generated based on bulk details.</small>
                            <textarea class="form-control mt-2" id="bulkUserNotes" rows="2" placeholder="Optional additional notes..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 p-4 bg-light">
                    <button type="button" class="btn btn-link text-muted fw-bold text-decoration-none px-4" data-bs-dismiss="modal">Discard</button>
                    <div class="ms-auto d-flex gap-2">
                        <button type="submit" class="btn btn-warning text-white fw-bold rounded-pill px-4 shadow-sm" id="bulkSubmitBtn">
                            Complete Bulk Stock In
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
"""

    new_content = f"{content[:start_idx]}{new_modal}{content[end_idx:]}"
    with codecs.open(file_path, 'w', encoding='utf-8') as f:
        f.write(new_content)
    print("Success")
else:
    print("Failed to find markers")
