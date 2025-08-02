<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // app/Models/Order.php
    protected $fillable = ['customer_name', 'total_price', 'status'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
