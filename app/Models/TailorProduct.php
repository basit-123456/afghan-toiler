<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TailorProduct extends Model
{
    protected $fillable = ['product_category_id', 'name', 'price', 'description', 'main_image'];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
