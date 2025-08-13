<?php

namespace Modules\Vendor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'is_active',
        'user_id'
    ];

    protected $casts = [
        'is_active' => 'boolean'
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