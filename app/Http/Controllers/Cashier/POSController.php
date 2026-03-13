<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Stock;
use App\Models\StockTransaction;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class POSController extends Controller
{
    /**
     * Display POS page
     */
    public function index()
    {
        // Get all active products with their stock
        $products = Product::with(['category', 'stock'])
            ->where('status', 'active')
            ->orderBy('product_name')
            ->get();
        
        $categories = Category::where('status', 'active')->get();
        
        return view('cashier.pos.index', compact('products', 'categories'));
    }

    /**
     * Process and store sale transaction
     */
    public function storeSale(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'customer_type' => 'required|in:regular,senior,pwd,pregnant',
            'payment_method' => 'required|in:cash,gcash,card',
            'amount_tendered' => 'required_if:payment_method,cash|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Check stocks first
            foreach ($request->items as $item) {
                $product = Product::with('stock')->find($item['product_id']);
                $stockQty = $product->stock->quantity ?? 0;
                
                if ($stockQty < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->product_name}. Available: {$stockQty}");
                }
            }

            // Generate receipt number
            $today = Carbon::today();
            $receiptCount = Sale::whereDate('created_at', $today)->count() + 1;
            $receiptNo = 'RCT-' . date('Ymd') . '-' . str_pad($receiptCount, 4, '0', STR_PAD_LEFT);

            // Calculate totals
            $subtotal = 0;
            foreach ($request->items as $item) {
                $subtotal += $item['quantity'] * $item['price'];
            }

            // Use values from request if provided (for manual discounts/taxes)
            $discountAmount = $request->input('discount_amount', 0);
            $taxAmount = $request->input('tax_amount', 0);
            $total = $request->input('total_amount', $subtotal - $discountAmount + $taxAmount);

            // Discount logic (fallback/audit)
            $discountRate = ($subtotal > 0) ? ($discountAmount / $subtotal) * 100 : 0;
            $discountType = $request->discount_type;

            if (!$discountType && $request->customer_type !== 'regular') {
                $discountType = ucfirst($request->customer_type);
            } elseif (!$discountType && $discountAmount > 0) {
                $discountType = 'Manual Discount';
            }

            // Create sale
            $sale = Sale::create([
                'receipt_no' => $receiptNo,
                'customer_type' => $request->customer_type,
                'discount_type' => $discountType,
                'discount_rate' => $discountRate,
                'discount_amount' => $discountAmount,
                'subtotal' => $subtotal,
                'tax' => $taxAmount,
                'total_amount' => $total,
                'payment_method' => $request->payment_method,
                'amount_paid' => $request->amount_tendered ?? $total,
                'change' => $request->payment_method === 'cash' ? 
                    ($request->amount_tendered - $total) : 0,
                'user_id' => Auth::id(),
                'status' => 'completed'
            ]);

            // Create sale items and update stock
            foreach ($request->items as $item) {
                $product = Product::with('stock')->find($item['product_id']);
                
                // Create sale item
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['quantity'] * $item['price']
                ]);

                // Update stock
                $stock = $product->stock;
                if ($stock) {
                    $oldQuantity = $stock->quantity;
                    $newQuantity = $oldQuantity - $item['quantity'];
                    
                    $stock->update(['quantity' => $newQuantity]);

                    // Create stock transaction
                    StockTransaction::create([
                        'stock_id' => $stock->id,
                        'product_id' => $item['product_id'],
                        'user_id' => Auth::id(),
                        'type' => 'out',
                        'quantity' => $item['quantity'],
                        'previous_quantity' => $oldQuantity,
                        'new_quantity' => $newQuantity,
                        'reason' => 'Sold via POS',
                        'notes' => 'Sale #' . $receiptNo
                    ]);

                    // Update product inventory status
                    $product->updateInventoryStatus();
                }
            }

            // Log activity
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'sale',
                'description' => "Completed sale #{$receiptNo} for ₱" . number_format($total, 2),
                'ip_address' => $request->ip()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sale completed successfully!',
                'receipt' => [
                    'receipt_no' => $receiptNo,
                    'items' => $request->items,
                    'subtotal' => $subtotal,
                    'discount_rate' => $discountRate * 100,
                    'discount_type' => $discountType,
                    'discount_amount' => $discountAmount,
                    'tax_amount' => $taxAmount,
                    'total' => $total,
                    'payment_method' => $request->payment_method,
                    'amount_tendered' => $request->amount_tendered ?? $total,
                    'change' => $request->payment_method === 'cash' ? 
                        ($request->amount_tendered - $total) : 0,
                    'cashier' => Auth::user()->full_name ?? Auth::user()->name,
                    'date' => now()->format('Y-m-d H:i:s')
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error processing sale: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get product by barcode
     */
    public function getProduct($barcode)
    {
        $product = Product::with('stock')
            ->where('barcode', $barcode)
            ->where('status', 'active')
            ->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $stockQty = $product->stock->quantity ?? 0;

        return response()->json([
            'success' => true,
            'product' => [
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => $product->selling_price,
                'stock' => $stockQty,
                'unit' => $product->unit,
                'barcode' => $product->barcode,
                'in_stock' => $stockQty > 0
            ]
        ]);
    }

    /**
     * Search products
     */
    public function searchProducts(Request $request)
    {
        $search = $request->input('q', '');
        
        if (empty($search)) {
            return response()->json([]);
        }
        
        $products = Product::with('stock')
            ->where('status', 'active')
            ->where(function($query) use ($search) {
                $query->where('product_name', 'like', "%{$search}%")
                    ->orWhere('barcode', 'like', "%{$search}%")
                    ->orWhere('product_code', 'like', "%{$search}%");
            })
            ->orderBy('product_name')
            ->take(20)
            ->get()
            ->map(function($product) {
                $stockQty = $product->stock->quantity ?? 0;
                return [
                    'id' => $product->id,
                    'name' => $product->product_name,
                    'price' => $product->selling_price,
                    'stock' => $stockQty,
                    'unit' => $product->unit,
                    'barcode' => $product->barcode,
                    'in_stock' => $stockQty > 0
                ];
            });

        return response()->json($products);
    }

    /**
     * Get today's sales summary
     */
    public function getTodaySales()
    {
        $today = Carbon::today();
        
        $sales = Sale::whereDate('created_at', $today)->get();
        $totalSales = $sales->sum('total_amount');
        $transactionCount = $sales->count();
        
        return response()->json([
            'success' => true,
            'total_sales' => $totalSales,
            'transaction_count' => $transactionCount
        ]);
    }

    /**
     * Get receipt data
     */
    public function getReceipt($saleId)
    {
        $sale = Sale::with(['items.product', 'cashier'])
            ->findOrFail($saleId);
            
        return response()->json([
            'success' => true,
            'receipt' => $sale
        ]);
    }
}