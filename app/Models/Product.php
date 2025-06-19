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
        'image', // <<< Tambahkan ini
    ];

    // Jika Anda punya relasi lain, definisikan di sini
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
