<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductYearTitle extends Model
{
    use HasFactory;
       public $table="products_year_titles";
    protected $fillable = [
    'id',
    'product_id',
    'title',
    'description',
    'is_active',
    'type',
    'is_active',
    'created_by',
    'updated_by',
    'created_at',
    'updated_at'
    ];
    public function getAllProductYearTitleByProductId($product_id,$type)
    {
      return ProductYearTitle::where('product_id',$product_id)
           ->where('type',$type)->first();
    }
}
