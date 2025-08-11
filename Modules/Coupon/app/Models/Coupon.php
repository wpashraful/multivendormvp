<?php

namespace Modules\Coupon\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Coupon\Database\Factories\CouponFactory;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'discount_amount',
        'valid_from',
        'expires_at',
        'max_usage',
        'used_count',
        'is_active',
        'lottery_id',
        'user_id',
    ];
    protected $casts = [
        'valid_from' => 'datetime',
        'expires_at' => 'datetime',
    ];

    // protected static function newFactory(): CouponFactory
    // {
    //     // return CouponFactory::new();
    // }


    //relation 
    public function lottery()
    {
        return $this->belongsTo(\Modules\Lottery\Models\Lottery::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
