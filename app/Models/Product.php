<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class, 'product_id');
    }
}
