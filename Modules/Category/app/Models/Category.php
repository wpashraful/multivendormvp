<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Models\Product;
// use Modules\Category\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','status'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
