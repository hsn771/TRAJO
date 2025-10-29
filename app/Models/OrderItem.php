<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable=['order_id', 'product_id', 'size_id', 'quantity', 'price', 'vendor_id', 'unit_price', 'line_total', 'status'];

    public function product(){
        return $this->belongsTo(product::class);
    }
}
