<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
class Product extends BaseModel
{
    use HasFactory;

    public function productLines()
    {
        return $this->hasMany(ProductLine::class, 'product_id');
    }
}
