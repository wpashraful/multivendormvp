<?php

namespace Modules\Vendor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_name',
        'business_description',
        'business_email',
        'business_phone',
        'business_address',
        'logo_url',
        'banner_url',
        'commission_rate',
        'status'
    ];

    protected $casts = [
        'commission_rate' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lotteries()
    {
        return $this->hasMany(\Modules\Lottery\Models\Lottery::class);
    }

    public function coupons()
    {
        return $this->hasManyThrough(\Modules\Coupon\Models\Coupon::class, \Modules\Lottery\Models\Lottery::class);
    }
}