<?php

namespace Modules\Lottery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Models\Product;
use App\Models\User;
// use Modules\Lottery\Database\Factories\LotteryFactory;

class Lottery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'ticket_price',
        'start_date',
        'end_date',
        'is_used',
        'used_at',
        'total_tickets',
        'sold_tickets',
        'is_active',
        'product_id',
        'vendor_id',
        'created_by',
        'status'
    ];

    protected $casts = [
        'is_used' => 'boolean',
        'used_at' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where('start_date', '<=', now())
                     ->where('end_date', '>=', now());
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function vendor()
    {
        return $this->belongsTo(\Modules\Vendor\Models\Vendor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function coupons()
    {
        return $this->hasMany(\Modules\Coupon\Models\Coupon::class);
    }

    public function products()
    {
        return $this->belongsToMany(\Modules\Product\Models\Product::class, 'lottery_product');
    }
}
