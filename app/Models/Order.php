<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;

class Order extends Model
{
    use HasFactory;

    protected $fillable=['user_id','coupon_id','total_price','discount_amount','final_price','status'];


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'user_id');
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
