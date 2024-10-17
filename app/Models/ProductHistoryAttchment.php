<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHistoryAttchment extends Model
{
    use HasFactory;
       public $table="products_history_attchments";
    protected $fillable = [
    'id',
    'product_id',
    'title',
    'youtube',
    'images',
    'is_active',
    'type',
    'created_by',
    'updated_by',
    'created_at',
    'updated_at'
    ];


    public function getProductHistoryAttchment($product_id,$type)
    {
      return  ProductHistoryAttchment::where('product_id',$product_id)->where('type',$type)->get();

    }
}
