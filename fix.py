import os

filepath = r"c:\xampplatest\htdocs\Minimart - sample\resources\views\Admin\Inventory\stock-out.blade.php"

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

target = """                            @endforeach
    <div class="modal-dialog modal-lg modal-dialog-centered">"""

replacement = """                            @endforeach
@else
                            <tr>
                                <td colspan="9" class="text-center py-5">
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
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($transactions->hasPages())
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

<!-- New Stock Out Modal -->
<div class="modal fade" id="newStockOutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">"""

new_content = content.replace(target, replacement)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(new_content)

print("Done")
