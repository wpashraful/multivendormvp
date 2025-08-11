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
        'start_date',
        'end_date',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'is_used' => 'boolean',
        'used_at' => 'datetime'
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function coupons()
    {
        return $this->hasMany(\Modules\Coupon\Models\Coupon::class);
    }
}
