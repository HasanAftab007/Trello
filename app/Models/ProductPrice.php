<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'name', 'stripe_price_id', 'currency', 'interval', 'type', 'amount', 'description'];

    public function productPriceFeatures() {
        return $this->hasMany(ProductPriceFeature::class);
    }

}


