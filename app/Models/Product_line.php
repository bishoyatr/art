<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_line extends Model
{
    use HasFactory;
        protected $fillable =
            [
              'name',
              'product_id',
              'is_active',
              'product_line_status',
              'created_by',
              'updated_by',
              'created_at',
              'updated_at'
    ];
       public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
        public function getAllProductLinesByProductId($product_id,$products_line_status)
    {

         return Product_line::where('product_id',$product_id)
             ->where('is_active',1)
             ->where(function($query)use ($products_line_status){
              $query->whereNull('product_line_status')->orwhere('product_line_status',$products_line_status);
                 })
             ->get();
    }
    public function current()
    {
        return $this->hasMany(CurrentProductLineAttatchment::class, 'product_id','product_line_id');
    } 
    
}
