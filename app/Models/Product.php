<?php

namespace App\Models;

use App\Enums\TaxType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $fillable = [
        'name',
        'slug',
        'code',
        'quantity',
        'quantity_alert',
        'buying_price',
        'selling_price',
        'tax',
        'tax_type',
        'notes',
        'product_image',
        'category_id',
        'unit_id',
        'created_at',
        'updated_at',
        "user_id",
        "uuid"
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'tax_type' => TaxType::class
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    protected function buyingPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    protected function sellingPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('code', 'like', "%{$value}%");
    }
    /**
     * Get the user that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetails::class);
    }



    public function movements(): Collection
    {
        $purchases = $this->purchaseDetails()->select('id', 'created_at as date', 'product_id', 'quantity', 'unitcost', 'total')
            ->get()
            ->map(function ($item) {
                $item['type'] = 'purchase';
                return $item;
            });
        $orders = $this->orderDetails()->select('id', 'created_at as date', 'product_id', 'quantity', 'unitcost', 'total')
            ->get()
            ->map(function ($item) {
                $item['type'] = 'order';
                return $item;
            });
        $movements = $purchases->isEmpty() ? $orders : $purchases->merge($orders);
        $movements = $movements->sortBy('date');
        return $movements;
    }
}
