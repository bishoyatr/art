<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
class Product extends BaseModel
{
    use HasFactory;
    protected $fillable = [
    'name',
    'category_id',
    'is_active',
    'product_status',
    'packaging_status',
    'created_by',
    'updated_by',
    'created_at',
    'updated_at'
    ];
    public function productLines()
    {
        return $this->hasMany(ProductLine::class, 'product_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function getAllProductsByCategoryId($category_id,$products_status,$packaging_status)
    {
         return Product::where('category_id',$category_id)
             ->where('is_active',1)
             ->where(function($query)use ($products_status){
              $query->whereNull('product_status')->orwhere('product_status',$products_status);
                 })
              ->where(function($query)use ($packaging_status){
              $query->whereNull('packaging_status')->orwhere('packaging_status',$packaging_status);
                 })
             ->get();
    }
}
