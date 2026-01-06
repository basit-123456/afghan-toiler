<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone_number'];

    public function orders()
    {
        return $this->hasMany(CustomerOrder::class);
    }
}
