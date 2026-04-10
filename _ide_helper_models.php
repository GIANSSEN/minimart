<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $action
 * @property string $description
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereUserId($value)
 * @mixin \Eloquent
 */
	class ActivityLog extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $brand_code
 * @property string $brand_name
 * @property string $slug
 * @property string|null $description
 * @property string|null $logo
 * @property string|null $website
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereBrandCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereBrandName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand withoutTrashed()
 * @property string|null $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereStatus($value)
 * @mixin \Eloquent
 */
	class Brand extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $category_name
 * @property string|null $description
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read mixed $icon_class
 * @property-read mixed $image_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withoutTrashed()
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereStatus($value)
 * @mixin \Eloquent
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string $customer_type
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCustomerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InventoryLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InventoryLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InventoryLog query()
 * @mixin \Eloquent
 */
	class InventoryLog extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $term_name
 * @property int $days_due
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm whereDaysDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm whereTermName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PaymentTerm extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $group
 * @property string|null $description
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission group($group)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $product_code
 * @property string|null $barcode
 * @property string $product_name
 * @property string|null $description
 * @property int $category_id
 * @property int|null $supplier_id
 * @property string|null $brand
 * @property string $unit
 * @property bool $has_expiry
 * @property \Illuminate\Support\Carbon|null $manufacturing_date
 * @property \Illuminate\Support\Carbon|null $expiry_date
 * @property int|null $shelf_life_days
 * @property string $product_type
 * @property numeric $cost_price
 * @property numeric $selling_price
 * @property numeric|null $wholesale_price
 * @property numeric $discount_percent
 * @property numeric $tax_rate
 * @property int $reorder_level
 * @property int $reorder_quantity
 * @property int|null $max_level
 * @property int|null $min_level
 * @property string|null $shelf_location
 * @property string|null $image
 * @property bool $has_variants
 * @property string $inventory_status
 * @property bool $is_phase_out
 * @property \Illuminate\Support\Carbon|null $phase_out_date
 * @property string|null $phase_out_reason
 * @property bool $needs_reorder
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\User|null $creator
 * @property-read mixed $current_stock
 * @property-read mixed $expiry_badge
 * @property-read mixed $expiry_status
 * @property-read mixed $in_stock
 * @property-read mixed $inventory_status_color
 * @property-read mixed $stock_badge_class
 * @property-read mixed $stock_display
 * @property-read mixed $stock_status
 * @property-read mixed $stock_status_color
 * @property-read mixed $stock_status_label
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InventoryLog> $inventoryLogs
 * @property-read int|null $inventory_logs_count
 * @property-read \App\Models\Stock|null $stock
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaction> $stockTransactions
 * @property-read int|null $stock_transactions_count
 * @property-read \App\Models\Supplier|null $supplier
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product expired()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product inStock()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product lowStock()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product nearExpiry($days = 30)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product outOfStock()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product phaseOut()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product search($search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCostPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDiscountPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereHasExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereHasVariants($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereInventoryStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereIsPhaseOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereManufacturingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereMaxLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereMinLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereNeedsReorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePhaseOutDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePhaseOutReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereProductCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereProductType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereReorderLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereReorderQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereShelfLifeDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereShelfLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereTaxRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereWholesalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withoutTrashed()
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereStatus($value)
 * @mixin \Eloquent
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \App\Models\User|null $creator
 * @property-read mixed $full_name
 * @property-read mixed $stock_status
 * @property-read mixed $stock_status_color
 * @property-read mixed $stock_status_label
 * @property-read \App\Models\Product|null $product
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SaleItem> $saleItems
 * @property-read int|null $sale_items_count
 * @property-read \App\Models\Stock|null $stock
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaction> $stockTransactions
 * @property-read int|null $stock_transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariant active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariant byProduct($productId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariant lowStock()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariant outOfStock()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariant search($search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariant withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariant withoutTrashed()
 * @mixin \Eloquent
 */
	class ProductVariant extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $variation_code
 * @property string $variation_name
 * @property string $variation_type
 * @property string|null $value
 * @property string|null $description
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $full_name
 * @property-read mixed $stock_status
 * @property-read mixed $stock_status_color
 * @property-read mixed $stock_status_label
 * @property-read \App\Models\Product|null $product
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SaleItem> $saleItems
 * @property-read int|null $sale_items_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation byProduct($productId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation lowStock()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation outOfStock()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation search($search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation whereVariationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation whereVariationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation whereVariationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation withoutTrashed()
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductVariation whereStatus($value)
 * @mixin \Eloquent
 */
	class ProductVariation extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string $guard_name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $receipt_no
 * @property int $user_id
 * @property string|null $customer_name
 * @property string|null $customer_type
 * @property string|null $discount_type
 * @property numeric|null $discount_rate
 * @property numeric|null $discount_amount
 * @property numeric $subtotal
 * @property numeric $tax
 * @property numeric $total_amount
 * @property string $payment_method
 * @property numeric $amount_paid
 * @property numeric $change
 * @property string $status
 * @property int|null $voided_by
 * @property string|null $voided_at
 * @property string|null $void_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $cashier
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SaleItem> $items
 * @property-read int|null $items_count
 * @property int|null $cashier_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereAmountPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereCashierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereChange($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereCustomerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereDiscountRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereReceiptNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereVoidReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereVoidedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sale whereVoidedBy($value)
 * @mixin \Eloquent
 */
	class Sale extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $sale_id
 * @property int $product_id
 * @property int $quantity
 * @property numeric $price
 * @property numeric $subtotal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Sale|null $sale
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SaleItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SaleItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SaleItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SaleItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SaleItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SaleItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SaleItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SaleItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SaleItem whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SaleItem whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SaleItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class SaleItem extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $sale_id
 * @property int $product_id
 * @property int $quantity
 * @property string $reason
 * @property numeric $refund_amount
 * @property string $status
 * @property int|null $processed_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $processor
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Sale $sale
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn whereProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn whereRefundAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalesReturn whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class SalesReturn extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $group
 * @property string $key
 * @property string|null $value
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereValue($value)
 * @mixin \Eloquent
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $product_id
 * @property int $quantity
 * @property int $min_quantity
 * @property int|null $max_quantity
 * @property string|null $location
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $status
 * @property-read mixed $status_color
 * @property-read mixed $status_label
 * @property-read \App\Models\User|null $lastCounter
 * @property-read \App\Models\Product|null $product
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereMaxQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereMinQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Stock extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $stock_id
 * @property int $product_id
 * @property int|null $supplier_id
 * @property int $user_id
 * @property string $type
 * @property int $quantity
 * @property float $unit_cost
 * @property float $total_cost
 * @property int $previous_quantity
 * @property int $new_quantity
 * @property string|null $received_date
 * @property string|null $received_by
 * @property string|null $reference
 * @property string|null $location
 * @property string|null $reason
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property numeric $unit_price
 * @property numeric $total_value
 * @property string|null $transaction_time
 * @property string|null $released_by
 * @property string|null $customer_name
 * @property string|null $authorized_by
 * @property-read mixed $type_color
 * @property-read mixed $type_icon
 * @property-read mixed $type_label
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Stock|null $stock
 * @property-read \App\Models\Supplier|null $supplier
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereAuthorizedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereNewQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction wherePreviousQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereReceivedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereReceivedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereReleasedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereTotalValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereTransactionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereUnitCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereUserId($value)
 * @mixin \Eloquent
 */
	class StockTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $supplier_code
 * @property string $supplier_name
 * @property string|null $contact_person
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $mobile
 * @property string|null $address
 * @property string|null $tax_id
 * @property string|null $payment_terms
 * @property int|null $created_by
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier search($search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier wherePaymentTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereSupplierCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereSupplierName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier withoutTrashed()
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereStatus($value)
 * @mixin \Eloquent
 */
	class Supplier extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $supplier_id
 * @property int $product_id
 * @property int $quantity
 * @property string $reason
 * @property string $return_date
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Supplier $supplier
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class SupplierReturn extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read int $days_since_expired
 * @property-read int $days_until_effective
 * @property-read string $effective_period
 * @property-read string $formatted_rate
 * @property-read int|null $products_count
 * @property-read string $status_badge
 * @property-read string $type_badge
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate default()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate withoutTrashed()
 * @property int $id
 * @property string $tax_code
 * @property string $name
 * @property numeric $rate
 * @property string $type
 * @property string|null $description
 * @property bool $is_default
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $effective_from
 * @property \Illuminate\Support\Carbon|null $effective_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereEffectiveFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereEffectiveTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereTaxCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxRate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class TaxRate extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $symbol
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement withoutTrashed()
 * @property string|null $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasurement whereStatus($value)
 * @mixin \Eloquent
 */
	class UnitOfMeasurement extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $employee_id
 * @property string $username
 * @property string $full_name
 * @property string $email
 * @property string|null $phone
 * @property string|null $address
 * @property string $password
 * @property string $role
 * @property string $status
 * @property string $approval_status
 * @property Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property string|null $last_login_at
 * @property string|null $last_login_ip
 * @property string|null $profile_photo
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivityLog> $activityLogs
 * @property-read int|null $activity_logs_count
 * @property-read User|null $approver
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $createdCategories
 * @property-read int|null $created_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $createdProducts
 * @property-read int|null $created_products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Supplier> $createdSuppliers
 * @property-read int|null $created_suppliers_count
 * @property-read User|null $creator
 * @property-read mixed $approval_badge
 * @property-read \Illuminate\Support\Carbon|null $approved_at
 * @property-read mixed $avatar_url
 * @property-read mixed $initials
 * @property-read \Illuminate\Support\Carbon|null $last_login
 * @property-read mixed $role_label
 * @property-read mixed $roles_list
 * @property-read mixed $status_badge
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sale> $sales
 * @property-read int|null $sales_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaction> $stockTransactions
 * @property-read int|null $stock_transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User approved()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User byRole($role)
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User pending()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User rejected()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User search($search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereApprovalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProfilePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 * @property string|null $rejection_reason
 * @property int|null $approved_by
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $directPermissions
 * @property-read int|null $direct_permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRejectionReason($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

