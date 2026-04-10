<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Stock;
use App\Models\StockTransaction;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockInEnhancementTest extends TestCase
{
    use RefreshDatabase;

    public function test_stock_in_with_new_fields_can_be_processed()
    {
        $user = User::factory()->create();
        $supplier = Supplier::create([
            'supplier_name' => 'Test Supplier',
            'contact_person' => 'Test Contact'
        ]);
        $product = Product::factory()->create(['cost_price' => 50.00]);
        $stock = Stock::create([
            'product_id' => $product->id,
            'quantity' => 10,
            'unit_id' => 1 // Assuming 1 is a valid unit ID
        ]);

        $response = $this->actingAs($user)->postJson(route('admin.inventory.process-stock-in'), [
            'product_id' => $product->id,
            'supplier_id' => $supplier->id,
            'quantity' => 100,
            'unit_cost' => 45.50,
            'received_date' => '2024-01-15',
            'received_by' => 'Test Receiver',
            'reference' => 'PO-12345',
            'reason' => 'purchase',
            'location' => 'Warehouse A',
            'notes' => 'Test notes'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // Verify transaction record
        $this->assertDatabaseHas('stock_transactions', [
            'product_id' => $product->id,
            'supplier_id' => $supplier->id,
            'quantity' => 100,
            'unit_cost' => 45.50,
            'total_cost' => 4550.00,
            'received_date' => '2024-01-15',
            'received_by' => 'Test Receiver',
            'reference' => 'PO-12345',
            'reason' => 'purchase',
            'location' => 'Warehouse A'
        ]);

        // Verify stock update
        $this->assertEquals(110, $stock->fresh()->quantity);
    }
}
