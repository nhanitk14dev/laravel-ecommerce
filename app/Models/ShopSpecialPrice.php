<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopSpecialPrice extends Model
{
    public $table = 'shop_special_price';
    public function product()
    {
        return $this->belongsTo('App\Models\ShopProduct', 'product_id', 'id');
    }
}
