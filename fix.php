<?php
$filepath = "c:\\xampplatest\\htdocs\\Minimart - sample\\resources\\views\\Admin\\Inventory\\stock-in.blade.php";
$content = file_get_contents($filepath);

$target = '                                @if(is_countable($transactions) ? count($transactions) > 0 : !empty($transactions))
                                                </span>
                                            </div>
                                            <span class="small">{{ $transaction->user->name ?? \'System\' }}</span>
                                        </div>
                                    </td>';

$replacement = '                                @if(is_countable($transactions) ? count($transactions) > 0 : !empty($transactions))
                                @foreach($transactions as $transaction)
                                @php
                                    $unitCost = $transaction->product->cost_price ?? 0;
                                    $totalCost = $transaction->quantity * $unitCost;
                                @endphp
                                <tr>
                                    <td class="px-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-day text-primary me-2"></i>
                                            <div>
                                                <div class="fw-semibold">{{ $transaction->created_at ? $transaction->created_at->format(\'M d, Y\') : \'N/A\' }}</div>
                                                <small class="text-muted">{{ $transaction->created_at ? $transaction->created_at->format(\'h:i A\') : \'\' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                                                <i class="fas fa-box text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-truncate" style="max-width:200px;">{{ Str::limit($transaction->product->product_name ?? \'Deleted Product\', 30) }}</div>
                                                <small class="text-muted">{{ $transaction->product->product_code ?? \'\' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-truck text-muted me-2"></i>
                                            <span class="text-muted">{{ $transaction->supplier->supplier_name ?? \'—\' }}</span>
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
                                            {{ $transaction->reference ?? \'—\' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar-initials-xs rounded-circle bg-info bg-opacity-10 text-info me-2">
                                                {{ $transaction->user ? substr($transaction->user->name ?? \'S\', 0, 1) : \'S\' }}
                                            </span>
                                            <span class="small">{{ $transaction->user->name ?? \'System\' }}</span>
                                        </div>
                                    </td>';

$new_content = str_replace($target, $replacement, $content);
file_put_contents($filepath, $new_content);
echo "PHP Fix Done\n";
