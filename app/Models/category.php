<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['name','slug','status'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
