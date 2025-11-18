<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

     protected $fillable = ['name', 'description', 'price', 'category_id', 'image_url'];

     protected $casts = [
    'gallery_images' => 'array',
];

     public function categories(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    // public function vendors(){
    //     return $this->belongsTo(Vendor::class, 'vendor_id');
    // }

    
}
