<?php
// app/Models/StockTransaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $stock_id
 * @property int $product_id
 * @property int $user_id
 * @property string $type
 * @property int $quantity
 * @property int $previous_quantity
 * @property int $new_quantity
 * @property string|null $reason
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $type_color
 * @property-read mixed $type_icon
 * @property-read mixed $type_label
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Stock|null $stock
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereNewQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction wherePreviousQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockTransaction whereUserId($value)
 * @mixin \Eloquent
 */
class StockTransaction extends Model
{
    use HasFactory;

    protected $table = 'stock_transactions';

    protected $fillable = [
        'stock_id',
        'product_id',
        'user_id',
        'type',
        'quantity',
        'previous_quantity',
        'new_quantity',
        'reference_type',
        'reference_id',
        'notes',
        'reason'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'previous_quantity' => 'integer',
        'new_quantity' => 'integer'
    ];

    const TYPE_IN = 'in';
    const TYPE_OUT = 'out';
    const TYPE_ADJUSTMENT = 'adjustment';
    const TYPE_RETURN = 'return';
    const TYPE_DAMAGE = 'damage';
    const TYPE_EXPIRED = 'expired';

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeColorAttribute()
    {
        return [
            self::TYPE_IN => 'success',
            self::TYPE_OUT => 'danger',
            self::TYPE_ADJUSTMENT => 'warning',
            self::TYPE_RETURN => 'info',
            self::TYPE_DAMAGE => 'danger',
            self::TYPE_EXPIRED => 'secondary'
        ][$this->type] ?? 'primary';
    }

    public function getTypeLabelAttribute()
    {
        return [
            self::TYPE_IN => 'Stock In',
            self::TYPE_OUT => 'Stock Out',
            self::TYPE_ADJUSTMENT => 'Adjustment',
            self::TYPE_RETURN => 'Return',
            self::TYPE_DAMAGE => 'Damage',
            self::TYPE_EXPIRED => 'Expired'
        ][$this->type] ?? $this->type;
    }

    public function getTypeIconAttribute()
    {
        return [
            self::TYPE_IN => 'fa-arrow-down',
            self::TYPE_OUT => 'fa-arrow-up',
            self::TYPE_ADJUSTMENT => 'fa-sliders-h',
            self::TYPE_RETURN => 'fa-undo',
            self::TYPE_DAMAGE => 'fa-times-circle',
            self::TYPE_EXPIRED => 'fa-clock'
        ][$this->type] ?? 'fa-exchange-alt';
    }
}