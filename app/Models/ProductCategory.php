<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name', 'image'];

    public function tailorProducts()
    {
        return $this->hasMany(TailorProduct::class);
    }
}
