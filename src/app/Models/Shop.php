<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'quantity',
        'subtotal',
    ];

    public function product()
   {
        return $this->belongsTo(Product::class);

   }

   public function category()
   {
        return $this->belongsTo(Category::class);
   }

}
